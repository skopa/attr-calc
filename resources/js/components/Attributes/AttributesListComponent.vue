<template>
  <div class="row justify-content-center">
    <div class="col-12 col-xl-10">
      <div class="card card-default">
        <div class="card-header">
          <b>Attributes</b>
        </div>

        <div class="table-responsive">
          <table class="table table-sm table-striped no-margin">
            <thead>
            <tr>
              <td>Path</td>
              <td>Name</td>
              <td>Rule</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in attributes">
              <td class="path">{{ item.path }}</td>
              <td>{{ item.name }}</td>
              <td>{{ item.rule.replaceAll('|', ', ') }}</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AttributesListComponent",
  data: function () {
    return {
      attributes: []
    }
  },
  mounted() {
    this.axios.get('/api/attributes')
        .then(response => this.attributes = response.data.data)
        .catch();
  },
  methods: {}
}
</script>

<style scoped>
.path {
  font-size: 0.9em;
  font-weight: bold;
}
</style>
