<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="card card-default" v-on:submit="save()" v-on:submit.prevent>
                <div class="card-header">
                    <b>Parameter</b>
                </div>

                <div class="card-body no-margin">

                    <div class="form-group">
                        <label for="name">Parameter name</label>
                        <input class="form-control" id="name"
                               v-model="parameter.name"
                               placeholder="Parameter name" required type="text">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="min">Min value:</label>
                            <input class="form-control"
                                   placeholder="Min value"
                                   id="min" type="number" step="any"
                                   v-bind:max="parameter.max"
                                   v-model="parameter.min" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="max">Max value:</label>
                            <input class="form-control"
                                   placeholder="Max value"
                                   id="max" type="number" step="any"
                                   v-bind:min="parameter.min"
                                   v-model="parameter.max" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="parameter">Parameter:</label>
                            <input class="form-control"
                                   placeholder="Parameter value"
                                   id="parameter" type="number" step="any"
                                   v-model="parameter.parameter" required>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button class="btn btn-outline-success btn-sm right" type="submit">Save parameter</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AttributeEditComponent",
        data: function () {
            return {
                parameter: {
                    name: null,
                    min: null,
                    max: null,
                    parameter: null
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.getData();
        },
        methods: {
            save: function () {
                this.saveData()
                    .then(() => {
                        this.$notify({
                            group: 'app',
                            type: 'success',
                            title: 'Saved',
                            text: 'Parameter saved successful.'
                        });

                        return this.$router.push({
                            name: 'attributes'
                        });
                    })
                    .catch();
            },
            getData: function () {
                if (!this.isNew()) {
                    this.axios.get('/api/attributes/' + this.$route.params.id)
                        .then(response => this.parameter = response.data)
                        .catch();
                }
            },
            saveData: function () {
                return this.isNew()
                    ? this.axios.post('/api/attributes', this.parameter)
                    : this.axios.put('/api/attributes/' + this.$route.params.id, this.parameter);
            },
            isNew: function () {
                return this.$route.params.id === 'new';
            }
        }
    }
</script>

<style scoped>

</style>
