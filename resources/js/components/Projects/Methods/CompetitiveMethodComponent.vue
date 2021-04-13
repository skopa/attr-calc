<template>
  <form v-on:submit="save()" v-on:submit.prevent v-if="value && parameters && parameters.parameters">

    <div class="form-group row">
      <label for="parameter-own_quality_value"
             class="col-sm-7 col-form-label">{{ parameters.own_quality_value.name }}:</label>
      <div class="col-sm-5">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-own_quality_value"
               v-model="value.competitive_method.own_quality_value"
               v-bind:class="{ 'is-invalid': error('own_quality_value') }"
               v-on:change="clear('own_quality_value')"
               type="number" step="any">
        <div class="invalid-feedback" v-for="err of error('own_quality_value')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-analog_quality_value"
             class="col-sm-7 col-form-label">{{ parameters.analog_quality_value.name }}:</label>
      <div class="col-sm-5">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-analog_quality_value"
               v-model="value.competitive_method.analog_quality_value"
               v-bind:class="{ 'is-invalid': error('analog_quality_value') }"
               v-on:change="clear('analog_quality_value')"
               type="number" step="any">
        <div class="invalid-feedback" v-for="err of error('analog_quality_value')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-weight_factor"
             class="col-sm-7 col-form-label">{{ parameters.weight_factor.name }}:</label>
      <div class="col-sm-5">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-weight_factor"
               v-model="value.competitive_method.weight_factor"
               v-bind:class="{ 'is-invalid': error('weight_factor') }"
               v-on:change="clear('weight_factor')"
               type="number" step="any">
        <div class="invalid-feedback" v-for="err of error('weight_factor')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-analog_implementation_costs"
             class="col-sm-7 col-form-label">{{ parameters.analog_implementation_costs.name }}:</label>
      <div class="col-sm-5">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-analog_implementation_costs"
               v-model="value.competitive_method.analog_implementation_costs"
               v-bind:class="{ 'is-invalid': error('analog_implementation_costs') }"
               v-on:change="clear('analog_implementation_costs')"
               type="number" step="any">
        <div class="invalid-feedback" v-for="err of error('analog_implementation_costs')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-own_implementation_costs"
             class="col-sm-7 col-form-label">{{ parameters.own_implementation_costs.name }}:</label>
      <div class="col-sm-5">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-own_implementation_costs"
               v-model="value.competitive_method.own_implementation_costs"
               v-bind:class="{ 'is-invalid': error('own_implementation_costs') }"
               v-on:change="clear('own_implementation_costs')"
               type="number" step="any">
        <div class="invalid-feedback" v-for="err of error('own_implementation_costs')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-analog_support_cost"
             class="col-sm-7 col-form-label">{{ parameters.analog_support_cost.name }}:</label>
      <div class="col-sm-5">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-analog_support_cost"
               v-model="value.competitive_method.analog_support_cost"
               v-bind:class="{ 'is-invalid': error('analog_support_cost') }"
               v-on:change="clear('analog_support_cost')"
               type="number" step="any">
        <div class="invalid-feedback" v-for="err of error('analog_support_cost')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-own_support_cost"
             class="col-sm-7 col-form-label">{{ parameters.own_support_cost.name }}:</label>
      <div class="col-sm-5">
        <input class="form-control"
               placeholder="Parameter value"
               id="parameter-own_support_cost"
               v-model="value.competitive_method.own_support_cost"
               v-bind:class="{ 'is-invalid': error('own_support_cost') }"
               v-on:change="clear('own_support_cost')"
               type="number" step="any">
        <div class="invalid-feedback" v-for="err of error('own_support_cost')">{{ err }}</div>
      </div>
    </div>

    <span class="horizontal-line mb-3"></span>

    <div class="form-group row">
      <label for="parameter-k1"
             class="col-sm-7 col-form-label">{{ parameters.k1.name }}:</label>
      <div class="col-sm-5">
        <select class="form-control" id="parameter-k1"
                v-model="value.competitive_method.k1"
                v-bind:class="{ 'is-invalid': error('k1') }"
                v-on:change="clear('k1')">
          <option :value="1.2">Ринок розвивається швидкими темпами</option>
          <option :value="1.05">Ринок має позитивні тенденції змін до зростання</option>
          <option :value="1">Ринок стабільний</option>
          <option :value="0.95">Ринок спадає</option>
          <option :value="0.8">Ринок спадає швидкими темпами</option>
        </select>
        <div class="invalid-feedback" v-for="err of error('k1')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-k2"
             class="col-sm-7 col-form-label">{{ parameters.k2.name }}:</label>
      <div class="col-sm-5">
        <select class="form-control" id="parameter-k2"
                v-model="value.competitive_method.k2"
                v-bind:class="{ 'is-invalid': error('k2') }"
                v-on:change="clear('k2')">
          <option :value="1.2">Ринок розвивається швидкими темпами</option>
          <option :value="1.05">Ринок має позитивні тенденції змін до зростання</option>
          <option :value="1">Ринок стабільний</option>
          <option :value="0.95">Ринок спадає</option>
          <option :value="0.8">Ринок спадає швидкими темпами</option>
        </select>
        <div class="invalid-feedback" v-for="err of error('k2')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-k3"
             class="col-sm-7 col-form-label">{{ parameters.k3.name }}:</label>
      <div class="col-sm-5">
        <select class="form-control" id="parameter-k3"
                v-model="value.competitive_method.k3"
                v-bind:class="{ 'is-invalid': error('k3') }"
                v-on:change="clear('k3')">
          <option :value="1.2">Ринок розвивається швидкими темпами</option>
          <option :value="1.05">Ринок має позитивні тенденції змін до зростання</option>
          <option :value="1">Ринок стабільний</option>
          <option :value="0.95">Ринок спадає</option>
          <option :value="0.8">Ринок спадає швидкими темпами</option>
        </select>
        <div class="invalid-feedback" v-for="err of error('k3')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-k4"
             class="col-sm-7 col-form-label">{{ parameters.k4.name }}:</label>
      <div class="col-sm-5">
        <select class="form-control" id="parameter-k4"
                v-model="value.competitive_method.k4"
                v-bind:class="{ 'is-invalid': error('k4') }"
                v-on:change="clear('k4')">
          <option :value="1.2">Ринок розвивається швидкими темпами</option>
          <option :value="1.05">Ринок має позитивні тенденції змін до зростання</option>
          <option :value="1">Ринок стабільний</option>
          <option :value="0.95">Ринок спадає</option>
          <option :value="0.8">Ринок спадає швидкими темпами</option>
        </select>
        <div class="invalid-feedback" v-for="err of error('k4')">{{ err }}</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="parameter-k5"
             class="col-sm-7 col-form-label">{{ parameters.k5.name }}:</label>
      <div class="col-sm-5">
        <select class="form-control" id="parameter-k5"
                v-model="value.competitive_method.k5"
                v-bind:class="{ 'is-invalid': error('k5') }"
                v-on:change="clear('k5')">
          <option :value="1.2">Ринок розвивається швидкими темпами</option>
          <option :value="1.05">Ринок має позитивні тенденції змін до зростання</option>
          <option :value="1">Ринок стабільний</option>
          <option :value="0.95">Ринок спадає</option>
          <option :value="0.8">Ринок спадає швидкими темпами</option>
        </select>
        <div class="invalid-feedback" v-for="err of error('k5')">{{ err }}</div>
      </div>
    </div>

    <span class="horizontal-line mb-3"></span>

    <div class="col-12 border rounded py-3 mb-3" v-for="(parameter, idx) in value.competitive_method.parameters">
      <div class="row">
        <div class="col-12 col-xl-8 form-group">
          <label v-bind:for="`parameter-${idx}-name`"
                 class="col-form-label">{{ parameters.parameters.name.name }}:</label>
          <div class="input-group">
            <input class="form-control"
                   placeholder="Parameter value"
                   v-bind:id="`parameter-${idx}-name`"
                   v-model="value.competitive_method.parameters[idx]['name']"
                   v-bind:class="{ 'is-invalid': error('parameters.' + idx + '.name') }"
                   v-on:change="clear('parameters.' + idx + '.name')"
                   type="text" step="any">
            <div class="invalid-feedback" v-for="err of error('parameters.' + idx + '.name')">{{ err }}</div>
          </div>
        </div>

        <div class="col-6 col-xl-4 form-group">
          <label class="col-form-label">{{ parameters.parameters.direction.name }}:</label>
          <div class="">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio"
                     v-bind:id="`period-${idx}-direct`"
                     v-model="value.competitive_method.parameters[idx]['direction']"
                     v-bind:class="{ 'is-invalid': error('parameters.' + idx + '.direction') }"
                     v-on:change="clear('parameters.' + idx + '.direction')"
                     v-bind:value="1">
              <label class="form-check-label" v-bind:for="`period-${idx}-direct`">Прямий</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio"
                     v-bind:id="`period-${idx}-indirect`"
                     v-model="value.competitive_method.parameters[idx]['direction']"
                     v-bind:class="{ 'is-invalid': error('parameters.' + idx + '.direction') }"
                     v-on:change="clear('parameters.' + idx + '.direction')"
                     v-bind:value="-1">
              <label class="form-check-label" v-bind:for="`period-${idx}-indirect`">Непрямий</label>
            </div>
            <div class="invalid-feedback" v-for="err of error('parameters.' + idx + '.direction')">{{ err }}</div>
          </div>
        </div>

        <div class="col-6 col-xl-4 form-group">
          <label v-bind:for="`period-${idx}-q_value`"
                 class="col-form-label">{{ parameters.parameters.q_value.name }}:</label>
          <div class="input-group">
            <input class="form-control"
                   placeholder="Parameter value"
                   v-bind:id="`period-${idx}-q_value`"
                   v-model="value.competitive_method.parameters[idx]['q_value']"
                   v-bind:class="{ 'is-invalid': error('parameters.' + idx + '.q_value') }"
                   v-on:change="clear('parameters.' + idx + '.q_value')"
                   type="number" step="any">
            <div class="invalid-feedback" v-for="err of error('parameters.' + idx + '.q_value')">{{ err }}</div>
          </div>
        </div>

        <div class="col-6 col-xl-4 form-group">
          <label v-bind:for="`period-${idx}-analog_value`"
                 class="col-form-label">{{ parameters.parameters.analog_value.name }}:</label>
          <div class="input-group">
            <input class="form-control"
                   placeholder="Parameter value"
                   v-bind:id="`period-${idx}-analog_value`"
                   v-model="value.competitive_method.parameters[idx]['analog_value']"
                   v-bind:class="{ 'is-invalid': error('parameters.' + idx + '.analog_value') }"
                   v-on:change="clear('parameters.' + idx + '.analog_value')"
                   type="number" step="any">
            <div class="invalid-feedback" v-for="err of error('parameters.' + idx + '.analog_value')">{{ err }}</div>
          </div>
        </div>

        <div class="col-6 col-xl-4 form-group">
          <label v-bind:for="`period-${idx}-own_value`"
                 class="col-form-label">{{ parameters.parameters.own_value.name }}:</label>
          <div class="input-group">
            <input class="form-control"
                   placeholder="Parameter value"
                   v-bind:id="`period-${idx}-own_value`"
                   v-model="value.competitive_method.parameters[idx]['own_value']"
                   v-bind:class="{ 'is-invalid': error('parameters.' + idx + '.own_value') }"
                   v-on:change="clear('parameters.' + idx + '.own_value')"
                   type="number" step="any">
            <div class="invalid-feedback" v-for="err of error('parameters.' + idx + '.own_value')">{{ err }}</div>
          </div>
        </div>
      </div>

      <div class="d-flex mt-1">
        <button class="btn btn-sm btn-outline-danger ml-auto mr-0" type="button"
                v-on:click="removeParameter(idx)">Remove
        </button>
      </div>
    </div>

    <div class="row mb-3" v-if="value.competitive_method.parameters.length < parameters.parameters_count.max">
      <div class="col-12">
        <button class="btn btn-sm btn-outline-secondary m-auto" type="button"
                v-on:click="addParameter">Add parameter
        </button>
      </div>
    </div>

    <span class="horizontal-line mb-3"></span>

    <div class="d-flex">
      <span class="d-block font-weight-bold">Обрахована вартість: {{ cost }}</span>
      <button class="btn btn-outline-success btn-sm ml-auto mr-0" type="submit">Save Method</button>
    </div>
  </form>
</template>

<script>
export default {
  name: "CompetitiveMethodComponent",
  props: ['value', 'parameters'],
  data: function () {
    return {
      errors: {}
    }
  },
  computed: {
    cost: function () {
      return (0).toFixed(2);
    }
  },
  methods: {
    error: function (field) {
      return _.get(this.errors, field, null);
    },
    clear: function (field) {
      return _.set(this.errors, field, null);
    },
    save: function () {
      const request = this.axios.put(`/api/projects/${this.$route.params.id}/competitive-method`, this.value.competitive_method);

      request.catch(response => {
        this.errors = response.response.data.errors;
      });

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

    addParameter() {
      this.value.competitive_method.parameters = this.value.competitive_method.parameters || [];

      if (this.value.competitive_method.parameters.length < this.parameters.parameters_count.max) {
        this.value.competitive_method.parameters?.push({});
        return;
      }

      this.$notify({
        group: 'app',
        type: 'error',
        title: 'Validation',
        text: 'Too many periods added! Max - ' + this.parameters.parameters_count.max
      });
    },

    removeParameter(idx) {
      this.value.competitive_method.parameters.splice(idx, 1);
    }
  }
}
</script>

<style scoped>

</style>
