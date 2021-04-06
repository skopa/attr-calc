<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">
          <b>Details</b>
          <a class="btn btn-outline-success btn-sm right" v-on:click="edit(project.id)">Edit project</a>
        </div>

        <div class="card-body">
          <h3>{{ project.name || '' }}</h3>
          <b>Project description:</b>
          <p>{{ project.description }}</p>
        </div>

        <span class="horizontal-line" v-if="project.cost_method"></span>
        <div class="card-body" v-if="project.cost_method">
          <h5 class="font-weight-bold">Витратний метод: {{ project.cost_method.cost }}</h5>

          <div class="table-responsive" v-if="attributes">
            <table class="table table-sm table-striped table-bordered">
              <tbody>
              <tr v-for="(parameter, key) in project.cost_method.sum">
                <td>{{ attributes.cost_method.sum[key].name }}</td>
                <td class="value">{{ parameter }}</td>
              </tr>
              <tr>
                <td>{{ attributes.cost_method.percentage_of_cost.name }}</td>
                <td>{{ project.cost_method.percentage_of_cost }}%</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>

        <span class="horizontal-line" v-if="project.revenue_method"></span>
        <div class="card-body" v-if="project.revenue_method && attributes">
          <h5 class="font-weight-bold">Дохідний метод: {{ project.revenue_method.cost }}</h5>

          <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered">
              <tbody>
              <tr>
                <td colspan="4">{{ attributes.revenue_method.discount_rate.name }}</td>
                <td>{{ project.revenue_method.discount_rate }}%</td>
              </tr>
              <tr>
                <td>Період</td>
                <td>{{attributes.revenue_method.period.sales_volume.name}}</td>
                <td>{{attributes.revenue_method.period.expected_price.name}}</td>
                <td>{{attributes.revenue_method.period.expected_cost.name}}</td>
                <td>{{attributes.revenue_method.period.licensor_percentage.name}}</td>
              </tr>
              <tr v-for="(period, idx) in project.revenue_method.periods">
                <td>{{ idx + 1 }}</td>
                <td>{{ period.sales_volume }}</td>
                <td>{{ period.expected_price }}</td>
                <td>{{ period.expected_cost }}</td>
                <td>{{ period.licensor_percentage }}%</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>


      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProjectDetailsComponent",
  data: function () {
    return {
      project: {
        id: null,
        name: null,
        score: null,
        description: null,
        has_competitors: null,
        ready_level: null,

        cost_method: null,
        competitive_method: {},
        revenue_method: {},
      },
      attributes: null
    }
  },
  mounted() {
    console.log('Component mounted.');
    this.getData(this.$route.params.id);
  },
  methods: {
    edit: function (id) {
      return this.$router.push({
        name: 'project-edit',
        params: {id}
      });
    },
    getData: function () {
      Promise.all([
        this.axios.get('/api/projects/' + this.$route.params.id),
        this.axios.get('/api/attributes')
      ]).then(([projectResponse, attributesResponse]) => {
        this.project = projectResponse.data.data;
        this.attributes = attributesResponse.data.data.reduce((carry, item) => _.set(carry, item.path, item), {});
        console.log(this.attributes);
      });
    }
  }
}
</script>

<style scoped>
.value {
  min-width: 5em;
}
</style>
