<template>
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <div class="card card-default">
        <div class="card-header">
          <b>Projects</b>
          <a class="btn btn-outline-success btn-sm right" v-on:click="create('new')">Create project</a>
        </div>

        <div class="table-responsive">
          <table id="projects-table" class="table table-striped">
            <thead>
            <tr>
              <th class="id">Id</th>
              <th class="name">Name</th>
              <th class="value">Cost Method</th>
              <th class="value">Competitive Method</th>
              <th class="value">Revenue Method</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(project, index) in projects">
              <td>{{ project.id }}</td>
              <td>
                <b>{{ project.name }}</b>
                <br>
                <small>Created by: {{ project.user.name }}</small>
              </td>
              <td>{{ project.cost_method.cost || 0 }}</td>
              <td>{{ project.competitive_method.cost || 0 }}</td>
              <td>{{ project.revenue_method.cost || 0 }}</td>
              <td class="control">
                <div>
                  <a class="btn btn-outline-primary btn-sm" v-on:click="view(project.id)">View</a>
                  <a class="btn btn-outline-danger btn-sm"
                     v-on:click="remove(project, index)">Delete</a>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>

        <div class="card-footer">
          <b-pagination class="mb-0 ml-auto"
                        size="sm"
                        align="right"
                        v-model="meta.current_page"
                        :total-rows="meta.total"
                        :per-page="meta.per_page"
                        aria-controls="projects-table"
                        v-on:change="getPage"
                        first-number
                        last-number
          ></b-pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProjectsListComponent",
  data: function () {
    return {
      projects: [],
      meta: {
        current_page: 1,
        from: 1,
        last_page: 1,
        per_page: 25,
        to: 3,
        total: 3,
      },
    }
  },
  mounted() {
    this.getPage();
  },
  methods: {
    create: function (id) {
      return this.$router.push({
        name: 'project-edit',
        params: {id}
      });
    },
    view: function (id) {
      return this.$router.push({
        name: 'project-details',
        params: {id}
      });
    },
    remove: function (project, index) {
      const answer = confirm(`Remove project '${project.name}' with all data about?`);
      if (answer) {
        this.axios
            .delete('/api/projects/' + project.id)
            .then(() => {
              this.projects.splice(index, 1);
              this.$notify({
                group: 'app',
                type: 'success',
                title: 'Deleted',
                text: `Project '${project.name}' deleted successful.`
              });
            })
      }
    },
    getPage(page = 1) {
      this.axios
          .get('/api/projects?per_page=' + this.meta.per_page + '&page=' + page.toString())
          .then(response => {
            this.projects = response.data.data;
            this.meta = response.data.meta;
          });
    }
  }
}
</script>

<style scoped>
.table th {
  vertical-align: revert;
}

.value {
  max-width: 150px;
  min-width: 70px;
  line-height: 1.2em;
}
</style>
