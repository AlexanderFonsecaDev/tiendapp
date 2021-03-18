<template>
    <div>
        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-10">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Listado de marcas creadas
                        </h6>
                        <button type="button" class="btn btn-primary" @click="create()">Crear</button>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table">
                            <thead class="table-light">
                            <tr class="text-center">
                                <th>Nombre</th>
                                <th>Referencia</th>
                                <th>Fecha de creacion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="mark in this.marks">
                                <td class="text-center" v-text="mark.attributes.name"></td>
                                <td class="text-center" v-text="mark.attributes.reference"></td>
                                <td class="text-center" v-text="mark.attributes.created_at"></td>
                                <td class="text-right">
                                    <button class="btn btn-sm btn-warning">
                                        Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "marks",
    props:['marks'],
    data() {
        return {}
    },
    mounted() {},
    methods: {}
}
</script>

<style scoped>

</style>
