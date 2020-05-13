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

                <h2>Listado de Roles</h2><br />                
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio">
                                <option value="nombre">Rol</option>
                                <option value="descripcion">Descripción</option>
                            </select>
                            <input type="text"  class="form-control" placeholder="Buscar texto" @keyup.enter="listarRole(1, buscar, criterio)" v-model="buscar">
                            <button type="submit" @click="listarRole(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr class="bg-primary">

                            <th>Rol</th>
                            <th>Descripción</th>
                            <th>Estado</th>                            
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="role in arrayRole" :key="role.id">

                            <td v-text="role.nombre"></td>
                            <td v-text="role.descripcion"></td>
                            <td>
                                <button type="button" class="btn btn-success btn-md" v-if="role.condicion">

                                    <i class="fa fa-check fa-2x"></i> Activo
                                </button>
                                <button type="button" class="btn btn-danger btn-md" v-else>

                                    <i class="fa fa-check fa-2x"></i> Desactivado
                                </button>

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
  

</main>
</template>

<script>

export default {
    data() {
        return {            
            role_id:0,
            nombre: '',
            descripcion: '',
            arrayRole: [], 
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

        listarRole(page, buscar, criterio) {

            let me = this;

            var url = '/role?page=' + page +'&buscar=' + buscar + '&criterio=' + criterio;

            axios.get(url)
                .then(function (response) {
                    // handle success
                   //console.log(response);
                    var respuesta = response.data;
                    me.arrayRole = respuesta.roles.data;
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
            me.listarRole(page, buscar, criterio);

        }
      
    },

    mounted() {
        this.listarRole(1, this.buscar, this.criterio);
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
