<template>
<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="/">BACKEND - SISTEMA DE COMPRAS - VENTAS</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">

                <h2>Listado de Productos</h2><br />

                <button class="btn btn-primary btn-lg" type="button" @click="abrirModal('producto', 'registrar')">
                    <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Producto
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio">
                                <option value="nombre">Producto</option>                              
                            </select>
                            <input type="text"  class="form-control" placeholder="Buscar texto" @keyup.enter="listarProducto(1, buscar, criterio)" v-model="buscar">
                            <button type="submit" @click="listarProducto(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr class="bg-primary">

                            <th>Categoría</th>
                            <th>Producto</th>
                            <th>Código</th>
                            <th>Precio Venta (USD$)</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Cambiar Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="producto in arrayProducto" :key="producto.id">

                            <td v-text="producto.nombre_categoria"></td>
                            <td v-text="producto.nombre"></td>
                            <td v-text="producto.codigo"></td>
                            <td v-text="producto.precio_venta"></td>
                            <td v-text="producto.stock"></td>
                            <td>
                                <button type="button" class="btn btn-success btn-md" v-if="producto.condicion">

                                    <i class="fa fa-check fa-2x"></i> Activo
                                </button>
                                <button type="button" class="btn btn-danger btn-md" v-else>

                                    <i class="fa fa-check fa-2x"></i> Desactivado
                                </button>

                            </td>

                            <td>
                                <button type="button" class="btn btn-info btn-md" @click="abrirModal('producto', 'actualizar', producto)">

                                    <i class="fa fa-edit fa-2x"></i> Editar
                                </button> &nbsp;
                            </td>

                            <td>
                             <template v-if="producto.condicion">
                                <button type="button" class="btn btn-danger btn-sm" @click="desactivarProducto(producto.id)">
                                    <i class="fa fa-lock fa-2x"></i> Desactivar
                                </button>
                             </template>
                             <template v-else>
                                <button type="button" class="btn btn-success btn-sm" @click="activarProducto(producto.id)">
                                    <i class="fa fa-lock fa-2x"></i> Activar
                                </button>
                             </template>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li v-if="pagination.current_page > 1" class="page-item">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)" >Anterior</a>
                        </li>
                        <li v-for="page in pagesNumber" :key="page" class="page-item" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                        </li>                       

                        <li v-if="pagination.current_page < pagination.last_page"  class="page-item">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio )">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" @click="cerrarModal()" class="close" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div v-show="errorProducto" class="form-group row div-error">

                        <div class="text-center text-error">

                            <div v-for="error in errorMostrarMsjProducto" :key="error" v-text="error" ></div>

                        </div>

                    </div>

                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">                  
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Categoría</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">

                            </div>
                        </div>                    

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="cerrarModal()"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                    <button type="button"  @click="registrarCategoria()" v-if="tipoAccion == 1" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                    <button type="button" @click="actualizarCategoria()" v-if="tipoAccion == 2" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Actualizar</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

</main>
</template>

<script>

export default {
    data() {
        return {            
            producto_id:0,
            idcategoria:0,
            nombre: '',
            precio_venta:0,
            stock:0,
            arrayProducto: [],
            modal:0,
            tituloModal:'',
            tipoAccion:0,
            errorProducto:0,
            errorMostrarMsjProducto:[],
            pagination:{
                "total": 0,
                "current_page": 0,
                "per_page": 0,
                "last_page": 0,
                "from": 0,
                "to": 0
            },
            
            offset: 3,
            criterio:'nombre',
            buscar:'',

        }

    },

    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        //calcula los elementos de la paginacion.
        pagesNumber: function(){        
          
            if(!this.pagination.to){
                return[];
            }
           var from = this.pagination.current_page - this.offset;
           if(from < 1){
               
               from = 1;

           }

           var to = from + (this.offset * 2);

           if(to >= this.pagination.last_page){

               to = this.pagination.last_page;
           } 

            var pagesArray = [];

            while(from <= to){

                pagesArray.push(from);                
                from++;
            }

            return pagesArray;

        }
    },

    methods: {

        listarProducto(page, buscar, criterio) {

            let me = this;

            var url = '/producto?page=' + page +'&buscar=' + buscar + '&criterio=' + criterio;

            axios.get(url)
                .then(function (response) {
                    // handle success
                   //console.log(response);
                    var respuesta = response.data;
                    me.arrayProducto = respuesta.productos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    //handle error
                    console.log(error);
                });

        },
        cambiarPagina(page, buscar, criterio){
            let me = this;          
            //actualiza la pagina actual 
            me.pagination.current_page = page;
            me.listarProducto(page, buscar, criterio);

        },
        registrarProducto() {
            
            if(this.validarProducto()){

                return;
            }
            
            let me = this;
            
            axios.post('/categoria/registrar',{
            'nombre':this.nombre,             

            })
                .then(function (response) {
                    // console.log(response);
                    me.cerrarModal();
                    me.listarProducto(1, '', 'nombre');
                })
                .catch(function (error) {
                    //handle error
                    console.log(error);
                });
        },
        actualizarProducto(){
              if(this.validarProducto()){

                return;
            }
            
            let me = this;
            axios.put('/Producto/actualizar',{               
            'id':this.categoria_id,    
            'nombre':this.nombre,                      
            })
                .then(function (response) {
                    //console.log(response);
                    me.cerrarModal();
                    me.listarProducto(1, '', 'nombre');
                })
                .catch(function (error) {
                    //handle error                                  
                    console.log(error);
                });
        },
        desactivarProducto(id){            
            swal({
                title: "Estas seguro de desactivar el producto?",              
                icon: "warning",
                buttons: true,                
                dangerMode: true,
                buttons: ["Cancelar", "Aceptar"]
                })
                .then((willDelete) => {
                if (willDelete) {
            let me = this;
            axios.put('/producto/desactivar',{               
            'id':id,    
                       
            })
              .then(function (response) {
                    //console.log(response);
                     swal("El producto ha sido desactivada exitosamente", {
                    icon: "success",
                    });                    
                    me.listarProducto(1, '', 'nombre');
             })
             .catch(function (error) {
                     swal("Error actuaizando intente de nuevo!");
                    //handle error                                  
                    console.log(error);
                });
                    
                   
                } 
             });
        },
   activarProducto(id){            
            swal({
                title: "Estas seguro de activar el producto?",              
                icon: "warning",
                buttons: true,                
                dangerMode: true,
                buttons: ["Cancelar", "Aceptar"]
                })
                .then((willDelete) => {
                if (willDelete) {
            let me = this;
            axios.put('/producto/activar',{               
            'id':id,    
                       
            })
              .then(function (response) {
                    //console.log(response);
                     swal("El Producto ha sido activada exitosamente", {
                    icon: "success",
                    });                   
                    me.listarProducto(1, '', 'nombre');
             })
             .catch(function (error) {
                     swal("Error actuaizando intente de nuevo!");
                    //handle error                                  
                    console.log(error);
                });
                    
                   
                } 
             });
        },
        validarProducto(){

        this.errorProducto = 0;
        this.errorMostrarMsjProducto = [];
        if(!this.nombre) this.errorMostrarMsjProducto.push("(*)El nombre de la categoria no puede estar vacio");
        
        if(this.errorMostrarMsjProducto.length) this.errorProducto = 1; 
         
        return this.errorProducto; 
        },
        cerrarModal(){
            this.modal = 0;
            this.tituloModal = "";
            this.nombre = "";     
        },
        abrirModal(modelo, accion, data = []) {
            switch (modelo) {
                case "producto": {
                    switch (accion) {

                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registar Producto";
                            this.nombre = "";                           
                            this.tipoAccion = 1;
                            
                            break;

                        }
                        case "actualizar": {

                            console.log(data);
                            this.modal = 1;
                            this.tituloModal = "Editar Producto";
                            this.tipoAccion = 2;
                            this.nombre = data["nombre"];                      
                            this.producto_id = data["id"];

                            break;
                        }

                    }
                }
            }
        }
    },

    mounted() {
        this.listarProducto(1, this.buscar, this.criterio);
        //console.log('component mounted');
    }
}
</script>
<style>

.modal-content{
 width: 100% !important;
 position: absolute !important;   
}
.mostrar{
    display:list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a;

}
.div-error{
display: flex;
justify-content: center;
}
.text-error{
    color: red !important;
    font-weight: bold;
    font-size: 20px;
}
</style>
