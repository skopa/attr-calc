<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <b>Details</b>
                    <a class="btn btn-outline-success btn-sm right" v-on:click="edit(project.id)">Edit project</a>
                </div>

                <div class="card-body">
                    <h3>{{project.name || ''}}</h3>
                    <h5>Total score: {{project.score || 0}}</h5>
                    <b>Project description:</b>
                    <p>{{project.description}}</p>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="id">#</td>
                            <td>Attribute name</td>
                            <td>Value</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(parameter, index) in project.parameters">
                            <td>{{index+1}}</td>
                            <td>{{parameter.name}}</td>
                            <td>{{parameter.value || 0}}</td>
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
        name: "ProjectDetailsComponent",
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
            this.getData(this.$route.params.id);
        },
        methods: {
            edit: function (id) {
                return this.$router.push({
                    name: 'edit-project',
                    params: {id}
                });
            },
            getData: function (id) {
                this.axios.get('/api/projects/' + id)
                    .then(response => this.project = response.data)
                    .catch()
            }
        }
    }
</script>

<style scoped>

</style>
