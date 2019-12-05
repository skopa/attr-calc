<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="card card-default" v-on:submit="save()" v-on:submit.prevent>
                <div class="card-header">
                    <b>Project:</b>
                </div>

                <div class="card-body">

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
                                  placeholder="Project description" required type="text"></textarea>
                    </div>

                    <h5>Parameters:</h5>

                    <div class="form-group row" v-for="parameter in project.parameters">
                        <label v-bind:for="`parameter-${parameter.id}`"
                               class="col-sm-7 col-form-label">{{parameter.name}}:</label>
                        <div class="col-sm-5">
                            <input class="form-control"
                                   placeholder="Parameter value"
                                   v-bind:id="`parameter-${parameter.id}`"
                                   v-bind:min="parameter.min"
                                   v-bind:max="parameter.max"
                                   v-model="parameter.value"
                                   type="number" step="any" required>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button class="btn btn-outline-success btn-sm right" type="submit">Save project</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProjectEditComponent",
        data: function () {
            return {
                project: {
                    name: null,
                    score: null,
                    description: null,
                    parameters: [],
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
                    .then(response => {
                        this.$notify({
                            group: 'app',
                            type: 'success',
                            title: 'Saved',
                            text: 'Project saved successful.'
                        });

                        return this.$router.push({
                            name: 'project-details',
                            params: {
                                id: response.data.id
                            }
                        });
                    })
                    .catch();
            },
            getData: function () {
                if (this.isNew()) {
                    this.axios.get('/api/attributes')
                        .then(response => this.project.parameters = response.data.data)
                        .catch();
                } else {
                    this.axios.get('/api/projects/' + this.$route.params.id)
                        .then(response => this.project = response.data)
                        .catch();
                }
            },
            saveData: function () {
                return this.isNew()
                    ? this.axios.post('/api/projects', this.project)
                    : this.axios.put('/api/projects/' + this.$route.params.id, this.project);
            },
            isNew: function () {
                return this.$route.params.id === 'new';
            }
        }
    }
</script>

<style scoped>

</style>
