<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Attributes</div>

                <table class="card-body table table-striped no-margin">
                    <thead>
                    <tr>
                        <td class="id">Id</td>
                        <td>Name</td>
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
                            <a class="btn btn-outline-success btn-sm" v-on:click="edit(item)">Edit</a>
                            <a class="btn btn-outline-danger btn-sm" v-on:click="remove(item, index)">Delete</a>
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
        name: "AttributesListComponent",
        data: function () {
            return {
                attributes: []
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.axios.get('/api/attributes')
                .then(response => this.attributes = response.data)
                .catch();
        },
        methods: {
            remove: function (project) {
                const answer = prompt(`Remove attribute '${project.name}' with all data about?`, 'No');
            }
        }
    }
</script>

<style scoped>
    .value {
        width: 90px;
    }
</style>
