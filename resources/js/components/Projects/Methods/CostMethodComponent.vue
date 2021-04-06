<template>
  <form v-on:submit="save()" v-on:submit.prevent v-if="value && attributes">
    <div class="form-group row" v-for="parameter in attributes">
      <label v-bind:for="`parameter-${parameter.key}`"
             class="col-sm-7 col-form-label">{{ parameter.name }}:</label>
      <div class="col-sm-5">
        <input class="form-control"
               placeholder="Parameter value"
               v-bind:id="`parameter-${parameter.key}`"
               v-bind:min="parameter.min"
               v-bind:max="parameter.max"
               v-model="value.cost_method.sum[parameter.key]"
               type="number" step="any" required>
      </div>
    </div>
    <div class="form-group row" v-if="parameters.percentage_of_cost">
      <label for="parameter-percentage_of_cost"
             class="col-sm-7 col-form-label">{{ parameters.percentage_of_cost.name }}:</label>
      <div class="col-sm-5 input-group">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-percentage_of_cost"
               v-bind:min="parameters.percentage_of_cost.min"
               v-bind:max="parameters.percentage_of_cost.max"
               v-model="value.cost_method.percentage_of_cost"
               type="number" step="any" required>
        <div class="input-group-append">
          <span class="input-group-text">%</span>
        </div>
      </div>
    </div>
    <span class="horizontal-line"></span>
    <div class="d-flex mt-3">
      <span class="ml-0 mr-auto font-weight-bold">Обрахована вартість: {{ cost }}</span>
      <button class="btn btn-outline-success btn-sm ml-auto mr-0" type="submit">Save Method</button>
    </div>
  </form>
</template>

<script>
export default {
  name: "CostMethodComponent",
  props: ['value', 'parameters'],
  data: function () {
    return {}
  },
  computed: {
    attributes: function () {
      return _.values(this.parameters.sum).sort((a, b) => a.order - b.order)
    },
    cost: function () {
      const percentage = parseFloat(this.value?.cost_method?.percentage_of_cost || 0);
      const sum = this.attributes.reduce((sum, attr) => sum + parseFloat(this.value.cost_method.sum[attr.key] || 0), 0);
      return (sum * (1 + percentage / 100)).toFixed(2);
    }
  },
  methods: {
    save: function () {
      const request = this.axios.put(`/api/projects/${this.$route.params.id}/cost-method`, this.value.cost_method);

      request.then(({data}) => {
        this.$emit('input', this.value = data.data);

        this.$notify({
          group: 'app',
          type: 'success',
          title: 'Saved',
          text: 'Project method saved successful.'
        });
      });
    },
  }
}
</script>

<style scoped>

</style>
