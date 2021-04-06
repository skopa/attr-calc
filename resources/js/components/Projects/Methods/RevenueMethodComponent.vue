<template>
  <form v-on:submit="save()" v-on:submit.prevent v-if="value && parameters && parameters.period">
    <div class="form-group row" v-if="parameters.discount_rate">
      <label for="parameter-percentage_of_cost"
             class="col-sm-7 col-form-label">{{ parameters.discount_rate.name }}:</label>
      <div class="col-sm-5 input-group">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-percentage_of_cost"
               v-bind:min="parameters.discount_rate.min"
               v-bind:max="parameters.discount_rate.max"
               v-model="value.revenue_method.discount_rate"
               type="number" step="any" required>
        <div class="input-group-append">
          <span class="input-group-text">%</span>
        </div>
      </div>
    </div>

    <div class="col-12 border rounded p-3 mb-3" v-for="(period, idx) in value.revenue_method.periods">
      <div class="row">
        <div class="col-6 col-xl-3 form-group">
          <label v-bind:for="`period-${idx}-sales_volume`"
                 class="col-sm-12 col-form-label">{{ parameters.period.sales_volume.name }}:</label>
          <div class="col-sm-12 input-group">
            <input class="form-control"
                   placeholder="Parameter value"
                   v-bind:id="`period-${idx}-sales_volume`"
                   v-bind:min="parameters.period.sales_volume.min"
                   v-model="value.revenue_method.periods[idx]['sales_volume']"
                   type="number" step="any" required>
          </div>
        </div>

        <div class="col-6 col-xl-3 form-group">
          <label v-bind:for="`period-${idx}-expected_price`"
                 class="col-sm-12 col-form-label">{{ parameters.period.expected_price.name }}:</label>
          <div class="col-sm-12 input-group">
            <input class="form-control"
                   placeholder="Parameter value"
                   v-bind:id="`period-${idx}-expected_price`"
                   v-bind:min="parameters.period.expected_price.min"
                   v-model="value.revenue_method.periods[idx]['expected_price']"
                   type="number" step="any" required>
          </div>
        </div>

        <div class="col-6 col-xl-3 form-group">
          <label v-bind:for="`period-${idx}-expected_cost`"
                 class="col-sm-12 col-form-label">{{ parameters.period.expected_cost.name }}:</label>
          <div class="col-sm-12 input-group">
            <input class="form-control"
                   placeholder="Parameter value"
                   v-bind:id="`period-${idx}-expected_cost`"
                   v-bind:min="parameters.period.expected_cost.min"
                   v-model="value.revenue_method.periods[idx]['expected_cost']"
                   type="number" step="any" required>
          </div>
        </div>

        <div class="col-6 col-xl-3 form-group">
          <label v-bind:for="`period-${idx}-licensor_percentage`"
                 class="col-sm-12 col-form-label">{{ parameters.period.licensor_percentage.name }}:</label>
          <div class="col-sm-12 input-group">
            <input class="form-control"
                   placeholder="Parameter value"
                   v-bind:id="`period-${idx}-licensor_percentage`"
                   v-bind:min="parameters.period.licensor_percentage.min"
                   v-bind:max="parameters.period.licensor_percentage.max"
                   v-model="value.revenue_method.periods[idx]['licensor_percentage']"
                   type="number" step="any" required>
            <div class="input-group-append">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </div>

      </div>
      <div class="d-flex mt-2">
        <span class="font-weight-bold">
          Прибуток Проєкту: {{ periods_cost[idx].sum.toFixed(2) }};
          прибуток ліцензіара: {{periods_cost[idx].licensor.toFixed(2) }}.
        </span>
        <button class="btn btn-sm btn-outline-danger ml-auto mr-0" type="button"
                v-on:click="removePeriod(idx)">Remove
        </button>
      </div>
    </div>

    <div class="row mb-3" v-if="value.revenue_method.periods.length < parameters.periods_count.max">
      <div class="col-12">
        <button class="btn btn-sm btn-outline-secondary m-auto" type="button"
                v-on:click="addPeriod">Add period</button>
      </div>
    </div>

    <span class="horizontal-line"></span>
    <div class="d-flex mt-3">
      <span class="d-block font-weight-bold">Обрахована вартість: {{ cost }}</span>
      <button class="btn btn-outline-success btn-sm ml-auto mr-0" type="submit">Save Method</button>
    </div>
  </form>
</template>

<script>
export default {
  name: "RevenueMethodComponent",
  props: ['value', 'parameters'],
  data: function () {
    return {}
  },
  computed: {
    periods_cost: function () {
      const discount = 1. + parseFloat(this.value?.revenue_method?.discount_rate || 0) / 100;

      return this.value.revenue_method.periods.map((period, idx) => {
        const sum = (
            parseFloat(period.sales_volume || 0)
            * (parseFloat(period.expected_price || 0) - parseFloat(period.expected_cost || 0))
            * Math.pow(discount, idx + 1)
        );
        const licensor = sum * (parseFloat(period.licensor_percentage) / 100);
        return {sum, licensor};
      })
    },
    cost: function () {
      const total = this.periods_cost.reduce((sum, item) => {
        return sum + (item.sum * 0.8 - item.licensor);
      }, 0);
      return total.toFixed(2);
    }
  },
  methods: {
    save: function () {
      const request = this.axios.put(`/api/projects/${this.$route.params.id}/revenue-method`, this.value.revenue_method);

      request.then(() => {
        this.$emit('input', this.value);

        this.$notify({
          group: 'app',
          type: 'success',
          title: 'Saved',
          text: 'Project method saved successful.'
        });
      });
    },

    addPeriod() {
      this.value.revenue_method.periods = this.value.revenue_method.periods || [];

      if (this.value.revenue_method.periods.length < this.parameters.periods_count.max) {
        this.value.revenue_method.periods?.push({});
        return;
      }

      this.$notify({
        group: 'app',
        type: 'error',
        title: 'Validation',
        text: 'Too many periods added! Max - ' + this.parameters.periods_count.max
      });
    },

    removePeriod(idx) {
      this.value.revenue_method.periods.splice(idx, 1);
    }
  }
}
</script>

<style scoped>

</style>
