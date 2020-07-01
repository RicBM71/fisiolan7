<template>
<div>
        <loading :show_loading="loading"></loading>
		<my-dialog :dialog.sync="dialog" registro="registro" @destroyReg="destroyReg"></my-dialog>
        <v-card>
            <v-card-title>
                <h2>{{titulo}}</h2>
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            v-on="on"
                            color="white"
                            icon
                            @click="show_filtro = !show_filtro"
                        >
                            <v-icon color="primary">mdi-filter-plus</v-icon>
                        </v-btn>
                    </template>
                    <span>Filtrar</span>
                </v-tooltip>
                <menu-ope></menu-ope>
            </v-card-title>
        </v-card>
        <v-card v-show="show_filtro">
            <v-card-title>
                <filtro :show_filtro.sync="show_filtro" :items.sync="items"></filtro>
            </v-card-title>
        </v-card>
        <v-card v-if="!loading">
            <v-card-title>
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Buscar"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>

            <v-data-table
                :search="search"
                :headers="headers"
                :items="items"
            >
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    @click="editItem(item.id)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="openDialog(item.id)"
                >
                    mdi-delete
                </v-icon>
            </template>
            </v-data-table>
        </v-card>
    </div>
</template>
<script>
import MyDialog from '@/components/shared/MyDialog'
import Loading from '@/components/shared/Loading'
import MenuOpe from './MenuOpe'
import Filtro  from './EmpleadoFiltro'
import {mapGetters} from 'vuex'
import {mapActions} from "vuex";
  export default {
    components: {
        'my-dialog': MyDialog,
        'menu-ope': MenuOpe,
        'loading': Loading,
        'filtro' : Filtro
    },
    data () {
      return {
        titulo: "Empleados",
        show_filtro: false,
        search:"",
        headers: [
            {
                text: 'Nombre',
                align: 'left',
                value: 'nom_ape'
            },
             {
                text: 'Categoría',
                align: 'left',
                value: 'categoria.nombre'
            },
            {
                text: 'Telefono',
                align: 'left',
                value: 'telefono1'
            },
            {
                text: 'Móvil',
                align: 'left',
                value: 'telefonom'
            },
            {
                text: 'mail',
                align: 'left',
                value: 'email'
            },
            {
                text: 'Acciones',
                align: 'Center',
                value: 'actions'
            }
        ],
        items:[],
        dialog: false,
        item_id: 0,
        loading: true

      }
    },
    mounted()
    {


        axios.get('/mto/empleados')
            .then(res => {

                this.items = res.data;
                //console.log(this.items);

            })
            .catch(err =>{
               ;
                this.$toast.error(err.response.data.message);
                this.$router.push({ name: 'dash' })
            })
            .finally(()=>{
                this.loading = false;
            });
    },
    computed: {
        ...mapGetters([
            'isRoot',
        ])
    },
    methods:{
        create(){
            this.$router.push({ name: 'empleado.create'})
        },
        editItem (id) {
            this.$router.push({ name: 'empleado.edit', params: { id: id } })
        },
        openDialog (id){
            this.dialog = true;
            this.item_id = id;
        },
        destroyReg () {
            this.dialog = false;

            axios.post('/mto/empleados/'+this.item_id,{_method: 'delete'})
                .then(res => {

                if (res.status == 200){
                    this.$toast.success('Empleado eliminado!');
                    this.items = res.data;
                }
                })
            .catch(err => {
                var msg = err.response.data.message;
                this.$toast.error(msg);

            });

        }
    }
  }
</script>
