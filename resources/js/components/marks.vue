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
                            Listado de marcas creadas
                        </h6>
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
                            <tr v-for="(mark ,index) in this.marks">
                                <td class="text-center" v-text="mark.attributes.name"></td>
                                <td class="text-center" v-text="mark.attributes.reference"></td>
                                <td class="text-center" v-text="mark.attributes.created_at"></td>
                                <td class="text-right">
                                    <button class="btn btn-sm btn-warning">
                                        Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger" @click="erase(mark,index)">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Registrar una nueva marca</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <form action="">
                                <label for="name">Nombre</label>
                                <input class="form-control" type="text" name="name" id="name" v-model="mark.attributes.name"
                                       placeholder="Nombre de la nueva marca">
                                <hr>

                                <label for="reference">Referencia</label>
                                <input class="form-control" type="text" name="reference" id="reference" v-model="mark.attributes.reference" placeholder="ABC123">

                                <hr>

                                <button type="button" class="btn btn-success btn-block" @click="create()" v-if="!edit">Crear</button>
                                <button type="button" class="btn btn-info btn-block" @click="change()" v-else>Actualizar</button>
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
    name: "marks",
    props:['marks'],
    data() {
        return {
            edit: false,
            mark: {
                id: '',
                attributes: {
                    name: '',
                    reference: '',
                }
            }
        }
    },
    mounted() {},
    methods: {
        create(){
            let self = this
            if (this.mark.attributes.name !== '' && this.mark.attributes.name !== undefined && this.mark.attributes.reference !== '' && this.mark.attributes.reference !== undefined){
                axios.post('/api/marks',{
                    name: this.mark.attributes.name,
                    reference: this.mark.attributes.reference
                })
                .then(function (response){
                    self.marks.push(response.data.data)
                    self.mark.attributes.name = ''
                    self.mark.attributes.reference = ''
                    self.$swal({
                        icon: 'success',
                        title: '¡Perfecto!',
                        text: 'Operación exitosa',
                    })
                })
                .catch(function (error){
                    this.$swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al momento de crear',
                    })
                })
            }
        },
        update(item){
            this.edit = true;
            let self = this
            this.mark.id = item.id
            this.mark.attributes.name = item.attributes.name
            this.mark.attributes.reference = item.attributes.reference
        },
        change(){
            let self = this
            let url = '/api/marks/' + this.mark.id
            axios.put(url,{
                name: this.mark.attributes.name,
                reference: this.mark.attributes.reference,
            })
                .then(function (response){
                    self.products = response.data.data
                    self.edit = false;
                    self.mark.id = ''
                    self.mark.attributes.name = ''
                    self.mark.attributes.reference = ''
                })
        },
        erase(item, index) {
            let self = this
            let url = '/api/marks/' + item.id
            axios.delete(url)
                .then(function (response) {
                    self.marks.splice(index, 1)
                    self.$swal({
                        icon: 'success',
                        title: '¡Perfecto!',
                        text: 'Operación exitosa',
                    })
                })
        }
    },
    computed: {
        edit() {
            return false
        }
    }
}
</script>

<style scoped>

</style>
