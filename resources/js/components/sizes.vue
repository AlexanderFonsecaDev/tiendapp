<template>
    <div>
        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Listado de tallas creadas
                        </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table">
                            <thead class="table-light">
                            <tr class="text-center">
                                <th>Nombre</th>
                                <th>Fecha de creacion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="size in this.sizes">
                                <td class="text-center" v-text="size.attributes.name"></td>
                                <td class="text-center" v-text="size.attributes.created_at"></td>
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

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Registrar una nueva talla</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <form action="">
                                <label for="name">Nombre</label>
                                <input class="form-control" type="text" name="name" id="name" v-model="this.name" placeholder="Nombre de la nueva talla">
                                <hr>
                                <button type="button" class="btn btn-success btn-block" @click="create()">Crear</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "sizes",
    props:['sizes'],
    data() {
        return {
            name : ''
        }
    },
    mounted() {},
    methods: {
        create(){
            let self = this
            if (this.name !== '' && this.name !== undefined){
                axios.post('/api/sizes',{
                    name : this.name
                })
                .then(function (response){
                    console.log("La respuesta del servidor para crear una talla es : ",response)
                    //self.sizes = response.data.data
                })
            }else{
                this.$swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe completar todos los campos para poder crear un nuevo elemento',
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
