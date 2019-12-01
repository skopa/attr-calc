<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <b>Projects</b>
                    <a class="btn btn-outline-success btn-sm right" v-on:click="create('new')">Create project</a>
                </div>

                <table class="card-body table table-striped no-margin">
                    <thead>
                    <tr>
                        <td class="id">Id</td>
                        <td>Name</td>
                        <td>Score</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(project, index) in projects">
                        <td>{{project.id}}</td>
                        <td>
                            <b>{{project.name}}</b>
                            <br>
                            <small>Created by: {{project.user.name}}</small>
                        </td>
                        <td>{{project.score || 0}}</td>
                        <td class="control">
                            <div>
                                <a class="btn btn-outline-primary btn-sm" v-on:click="view(project.id)">View</a>
                                <a class="btn btn-outline-danger btn-sm" v-on:click="remove(project, index)">Delete</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProjectsListComponent",
        data: function () {
            return {
                projects: []
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.getPage();
        },
        methods: {
            create: function (id) {
                return this.$router.push({
                    name: 'edit-project',
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
                    .get('/api/projects?page=' + page.toString())
                    .then(response => (this.projects = response.data.data));
            }
        }
    }
</script>

<style scoped>

</style>
