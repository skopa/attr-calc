<template>
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <div class="card card-default">
                <div class="card-header">
                    <b>Attributes</b>
                    <a class="btn btn-outline-success btn-sm right" v-on:click="edit('new')">Create new</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <td class="id">Id</td>
                            <td class="name">Name</td>
                            <td class="value">Min</td>
                            <td class="value">Max</td>
                            <td class="value">Parameter</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in attributes">
                            <td>{{item.id}}</td>
                            <td>{{item.name}}</td>
                            <td>{{item.min}}</td>
                            <td>{{item.max}}</td>
                            <td>{{item.parameter}}</td>
                            <td class="control">
                                <div>
                                    <a class="btn btn-outline-success btn-sm" v-on:click="edit(item.id)">Edit</a>
                                    <a class="btn btn-outline-danger btn-sm" v-on:click="remove(item, index)">Delete</a>
                                </div>
                            </td>
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
            console.log('Component mounted.');

            this.axios.get('/api/attributes')
                .then(response => this.attributes = response.data.data)
                .catch();
        },
        methods: {
            edit: function (id) {
                return this.$router.push({
                    name: 'edit-attribute',
                    params: {id}
                });
            },
            remove: function (parameter, index) {
                const answer = confirm(`Remove attribute '${parameter.name}' with all data about?`);
                if (answer) {
                    this.axios
                        .delete('/api/attributes/' + parameter.id)
                        .then(() => {
                            this.attributes.splice(index, 1);
                            this.$notify({
                                group: 'app',
                                type: 'success',
                                title: 'Deleted',
                                text: `Attribute '${parameter.name}' deleted successful.`
                            });
                        })
                }
            }
        }
    }
</script>

<style scoped>
    .value {
        width: 90px;
    }
</style>
