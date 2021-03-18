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
                            Listado de productos creados
                        </h6>
                        <button type="button" class="btn btn-primary" @click="create()">Crear</button>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table">
                            <thead class="table-light">
                            <tr class="text-center">
                                <th>Nombre</th>
                                <th>Talla</th>
                                <th>Marca</th>
                                <th>Cantidad inventario</th>
                                <th>Fecha de embarque</th>
                                <th>Observaciones</th>
                                <th>Operaciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in this.products">
                                <td class="text-center" v-text="product.attributes.name"></td>
                                <td class="text-center" v-text="product.attributes.size"></td>
                                <td class="text-center" v-text="product.attributes.mark"></td>
                                <td class="text-center" v-text="product.attributes.quantity"></td>
                                <td class="text-center" v-text="product.attributes.date_shipment"></td>
                                <td class="text-center" v-text="product.attributes.observation"></td>
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
    props:['marks','sizes'],
    data() {
        return {
            products: [],
            selected_mark: '',
            selected_size: '',
        }
    },
    mounted() {
        let self = this
        axios.get('/api/products')
            .then(function (response) {
                self.products = response.data.data
            })
    },
    methods: {
        async create() {
            let self = this
            console.log("Las marcas con ",this.marks)
            const {value: formValues} = await this.$swal({
                title: 'Crear un nuevo producto',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                html:
                    '<label>Nombre</label>' +
                    '<input id="name" class="swal2-input" required>' +
                    '<label>Cantidad</label>' +
                    '<input id="quantity" type="number" class="form-control swal2-input">' +
                    '<label>Observaciones</label>' +
                    '<input id="observation" class="swal2-input">'+
                    '<label>Fecha de embarque</label>' +
                    '<input id="date_shipment" type="date" class="swal2-input">'+
                    '<label>Marca</label>' +
                    `<select class="form-control" v-model="${this.selected_mark}">'+'<option v-for="mark in ${this.marks}" :value="mark.id" v-text="mark.attributes.name"></option>'+'</select>`
                ,
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById('name').value,
                        document.getElementById('quantity').value,
                        document.getElementById('observation').value,
                        document.getElementById('date_shipment').value
                    ]
                }
            })

            if (formValues) {
                let json = JSON.stringify(formValues)
                console.log("Producto : ",json)
            }

        }
    }
}
</script>

<style scoped>

</style>
