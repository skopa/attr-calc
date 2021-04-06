<template>
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <div class="card card-default">
        <div class="card-header">
          <b>Project: {{ project.name }}</b>
          <a class="btn btn-outline-primary btn-sm right" v-on:click="view()">View</a>
        </div>

        <div class="card-body">

          <form v-on:submit="save()" v-on:submit.prevent>

            <div class="form-group">
              <label for="name">Project name</label>
              <input class="form-control" id="name"
                     v-model="project.name"
                     placeholder="Project name" required type="text">
            </div>

            <div class="form-group">
              <label for="description">Project description</label>
              <textarea class="form-control" id="description"
                        rows="3"
                        v-model="project.description"
                        placeholder="Project description" type="text"></textarea>
            </div>

            <div class="form-group">
              <label for="ready_level">{{ parameters.project_ready_level.name }}</label>
              <input class="form-control" id="ready_level"
                     step="0.0001"
                     v-model="project.ready_level"
                     v-bind:min="parameters.project_ready_level.min"
                     v-bind:max="parameters.project_ready_level.max"
                     v-bind:placeholder="parameters.project_ready_level.name" required type="number">
            </div>

            <div class="form-group custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="has_competitors" placeholder="Project name"
                     v-model="project.has_competitors">
              <label class="custom-control-label" for="has_competitors">{{ parameters.has_competitors.name }}</label>
            </div>

            <div class="d-flex">
              <button class="btn btn-outline-success btn-sm ml-auto mr-0" type="submit">Save Project</button>
            </div>

          </form>

          <b-tabs class="mt-3" content-class="mt-3" justified v-if="!isNew()">
            <b-tab title="Витратний метод" active>
              <cost-method v-model="project" v-bind:parameters="parameters.cost_method"></cost-method>
            </b-tab>
            <b-tab title="Second" v-bind:disabled="project.ready_level >= 4">
              <competitive-method v-model="project" v-bind:parameters="parameters.competitive_method"></competitive-method>
            </b-tab>
            <b-tab title="Дохідний метод" v-bind:disabled="!project.has_competitors">
              <revenue-method v-model="project" v-bind:parameters="parameters.revenue_method"></revenue-method>
            </b-tab>
          </b-tabs>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CostMethodComponent from './Methods/CostMethodComponent'
import RevenueMethodComponent from './Methods/RevenueMethodComponent'
import CompetitiveMethodComponent from './Methods/CompetitiveMethodComponent'

export default {
  name: "ProjectEditComponent",
  components: {
    'cost-method': CostMethodComponent,
    'revenue-method': RevenueMethodComponent,
    'competitive-method': CompetitiveMethodComponent,
  },
  data: function () {
    return {
      project: {
        name: null,
        description: null,
        ready_level: null,
        has_competitors: false,
        cost_method: {},
        revenue_method: {},
        competitive_method: {}
      },
      parameters: {
        project_ready_level: {},
        has_competitors: {},
        cost_method: {},
        revenue_method: {}
      }
    }
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData: function () {
      const processAttributes = (response) => {
        const data = response.data.data || [];
        this.parameters = data.reduce((carry, item) => _.set(carry, item.path, item), {});
      }

      const chain = this.isNew()
          ? this.axios.get('/api/attributes')
          : this.axios.get('/api/projects/' + this.$route.params.id)
              .then(response => {
                this.project = response.data.data;
                return this.axios.get('/api/attributes')
              });

      chain
          .then(processAttributes)
          .catch();

    },
    save: function () {
      const request = this.isNew()
          ? this.axios.post('/api/projects', this.project)
          : this.axios.put('/api/projects/' + this.$route.params.id, this.project);

      request.then(response => {
        this.project = _.assign(this.project, response.data.data);

        this.$notify({
          group: 'app',
          type: 'success',
          title: 'Saved',
          text: 'Project saved successful.'
        });

        return this.$router.push({
          name: 'project-edit',
          params: {id: this.project.id}
        });
      });
    },
    view: function () {
      return this.$router.push({
        name: 'project-details',
        params: {id: this.$route.params.id}
      });
    },
    isNew: function () {
      return this.$route.params.id === 'new';
    },
  }
}
</script>

<style scoped>

</style>
