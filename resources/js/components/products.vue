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
                            Listado de productos creados
                        </h6>
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
                            <tr v-for="(product,index) in this.products">
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
                                    <button class="btn btn-sm btn-danger" @click="erase(product,index)">
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
                        <h6 class="m-0 font-weight-bold text-primary">Registrar un nuevo producto</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <form action="">
                                <label for="name">Nombre</label>
                                <input class="form-control" type="text" name="name" id="name"
                                       v-model="product.attributes.name"
                                       placeholder="Nombre del producto">
                                <hr>

                                <label for="quantity">Cantidad</label>
                                <input class="form-control" type="text" name="quantity" id="quantity"
                                       v-model="product.attributes.quantity" placeholder="1,2,3,4,5">

                                <hr>

                                <label for="observation">Observación</label>
                                <input class="form-control" type="text" name="observation" id="observation"
                                       v-model="product.attributes.observation" placeholder="1,2,3,4,5">

                                <hr>

                                <label for="date_shipment">Fecha de embarque</label>
                                <input class="form-control" type="date" name="date_shipment" id="date_shipment"
                                       v-model="product.attributes.date_shipment">

                                <hr>

                                <label for="mark">Marca</label>
                                <select name="mark" id="mark" v-model="product.attributes.mark" class="form-control">
                                    <option v-for="(mark,index) in marks" :value="mark.id"
                                            v-text="mark.attributes.name"></option>
                                </select>

                                <hr>

                                <label for="size">Talla</label>
                                <select name="size" id="size" v-model="product.attributes.size" class="form-control">
                                    <option v-for="(size,index) in sizes" :value="size.id"
                                            v-text="size.attributes.name"></option>
                                </select>

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
    props: ['marks', 'sizes'],
    data() {
        return {
            products: [],
            selected_mark: '',
            selected_size: '',
            product: {
                id: '',
                attributes: {
                    date_shipment: '',
                    mark: '',
                    name: '',
                    observation: '',
                    quantity: '',
                    size: ''
                }
            }
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
        create() {
            let self = this
            axios.post('/api/products', {
                size_id: this.product.attributes.size,
                mark_id: this.product.attributes.mark,
                name: this.product.attributes.name,
                quantity: this.product.attributes.quantity,
                date_shipment: this.product.attributes.date_shipment,
                observation: this.product.attributes.observation
            })
                .then(function (response) {
                    self.products.push(response.data.data)
                    self.product.attributes.size = ''
                    self.product.attributes.mark = ''
                    self.product.attributes.name = ''
                    self.product.attributes.quantity = ''
                    self.product.attributes.date_shipment = ''
                    self.product.attributes.observation = ''
                    self.$swal({
                        icon: 'success',
                        title: '¡Perfecto!',
                        text: 'Operación exitosa',
                    })
                })

        },
        erase(item, index) {
            let self = this
            let url = '/api/products/' + item.id
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
    }
}
</script>

<style scoped>

</style>
