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

                <h2>Listado de Categorías</h2><br />

                <button class="btn btn-primary btn-lg" type="button" @click="abrirModal('categoria', 'registrar')">
                    <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Categoría
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3">
                                <option value="nombre">Categoría</option>
                                <option value="descripcion">Descripción</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Buscar texto">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr class="bg-primary">

                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Cambiar Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="categoria in arrayCategoria" :key="categoria.id">

                            <td v-text="categoria.nombre"></td>
                            <td v-text="categoria.descripcion"></td>
                            <td>
                                <button type="button" class="btn btn-success btn-md" v-if="categoria.condicion">

                                    <i class="fa fa-check fa-2x"></i> Activo
                                </button>
                                <button type="button" class="btn btn-danger btn-md" v-else>

                                    <i class="fa fa-check fa-2x"></i> Desactivado
                                </button>

                            </td>

                            <td>
                                <button type="button" class="btn btn-info btn-md" @click="abrirModal('categoria', 'registrar', categoria)">

                                    <i class="fa fa-edit fa-2x"></i> Editar
                                </button> &nbsp;
                            </td>

                            <td>
                             <template v-if="categoria.condicion">
                                <button type="button" class="btn btn-danger btn-sm" @click="desactivarCategoria(categoria.id)">
                                    <i class="fa fa-lock fa-2x"></i> Desactivar
                                </button>
                             </template>
                             <template v-else>
                                <button type="button" class="btn btn-success btn-sm" @click="activarCategoria(categoria.id)">
                                    <i class="fa fa-lock fa-2x"></i> Activar
                                </button>
                             </template>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">Anterior</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
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

                    <div v-show="errorCategoria" class="form-group row div-error">

                        <div class="text-center text-error">

                            <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error" ></div>

                        </div>

                    </div>

                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">                  
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Categoría</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="email" v-model="descripcion" class="form-control" placeholder="Ingrese descripcion">
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
            categoria_id:0,
            nombre: '',
            descripcion: '',
            arrayCategoria: [],
            modal:0,
            tituloModal:'',
            tipoAccion:0,
            errorCategoria:0,
            errorMostrarMsjCategoria:[]
        }
    },

    methods: {

        listarCategoria() {

            let me = this;

            axios.get('/categoria')
                .then(function (response) {
                    // handle success
                    // console.log(response);
                    me.arrayCategoria = response.data;
                })
                .catch(function (error) {
                    //handle error
                    console.log(error);
                });

        },
        registrarCategoria() {
            
            if(this.validarCategoria()){

                return;
            }
            
            let me = this;
            
            axios.post('/categoria/registrar',{
            'nombre':this.nombre,
            'descripcion':this.descripcion    

            })
                .then(function (response) {
                    // console.log(response);
                    me.cerrarModal();
                    me.listarCategoria();
                })
                .catch(function (error) {
                    //handle error
                    console.log(error);
                });
        },
        actualizarCategoria(){
              if(this.validarCategoria()){

                return;
            }
            
            let me = this;
            axios.put('/categoria/actualizar',{               
            'id':this.categoria_id,    
            'nombre':this.nombre,
            'descripcion':this.descripcion            
            })
                .then(function (response) {
                    //console.log(response);
                    me.cerrarModal();
                    me.listarCategoria();
                })
                .catch(function (error) {
                    //handle error                                  
                    console.log(error);
                });
        },
        desactivarCategoria(id){            
            swal({
                title: "Estas seguro de desactivar la categoria?",              
                icon: "warning",
                buttons: true,                
                dangerMode: true,
                buttons: ["Cancelar", "Aceptar"]
                })
                .then((willDelete) => {
                if (willDelete) {
            let me = this;
            axios.put('/categoria/desactivar',{               
            'id':id,    
                       
            })
              .then(function (response) {
                    //console.log(response);
                     swal("La categoria ha sido desactivada exitosamente", {
                    icon: "success",
                    });
                    me.cerrarModal();
                    me.listarCategoria();
             })
             .catch(function (error) {
                     swal("Error actuaizando intente de nuevo!");
                    //handle error                                  
                    console.log(error);
                });
                    
                   
                } 
             });
        },
   activarCategoria(id){            
            swal({
                title: "Estas seguro de activar la categoria?",              
                icon: "warning",
                buttons: true,                
                dangerMode: true,
                buttons: ["Cancelar", "Aceptar"]
                })
                .then((willDelete) => {
                if (willDelete) {
            let me = this;
            axios.put('/categoria/activar',{               
            'id':id,    
                       
            })
              .then(function (response) {
                    //console.log(response);
                     swal("La categoria ha sido activada exitosamente", {
                    icon: "success",
                    });
                    me.cerrarModal();
                    me.listarCategoria();
             })
             .catch(function (error) {
                     swal("Error actuaizando intente de nuevo!");
                    //handle error                                  
                    console.log(error);
                });
                    
                   
                } 
             });
        },
        validarCategoria(){

        this.errorCategoria = 0;
        this.errorMostrarMsjCategoria = [];
        if(!this.nombre) this.errorMostrarMsjCategoria.push("(*)El nombre de la categoria no puede estar vacio");
        
        if(this.errorMostrarMsjCategoria.length) this.errorCategoria = 1; 
         
        return this.errorCategoria; 
        },
        cerrarModal(){
            this.modal = 0;
            this.tituloModal = "";
            this.nombre = "";
            this.descripcion = "";
        },
        abrirModal(modelo, accion, data = []) {
            switch (modelo) {
                case "categoria": {
                    switch (accion) {

                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registar categoria";
                            this.nombre = "";
                            this.descripcion = "";
                            this.tipoAccion = 1;
                            

                        }
                        case "actualizar": {

                           // console.log(data);
                            this.modal = 1;
                            this.tituloModal = "Editar Categoria";
                            this.tipoAccion = 2;
                            this.nombre = data["nombre"];
                            this.descripcion = data["descripcion"];
                            this.categoria_id = data["id"];

                        }

                    }
                }
            }
        }
    },

    mounted() {
        this.listarCategoria();
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
