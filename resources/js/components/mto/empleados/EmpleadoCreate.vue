<template>
	<div>
        <loading :show_loading="loading"></loading>
        <v-card>
            <v-card-title color="indigo">
                <h2 color="indigo">{{titulo}}</h2>
                <v-spacer></v-spacer>
                <menu-ope :id="empleado.id"></menu-ope>
            </v-card-title>
        </v-card>
        <v-card v-show="!loading">
            <v-form>
                <v-container>
                    <v-row>
                        <v-col
                            cols="12"
                            md="2"
                        >
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.nombre"
                                v-validate="'required'"
                                :error-messages="errors.collect('nombre')"
                                label="Nombre"
                                data-vv-name="nombre"
                                data-vv-as="nombre"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-text-field
                                v-model="empleado.apellidos"
                                v-validate="'required'"
                                :error-messages="errors.collect('apellidos')"
                                label="Apellidos"
                                data-vv-name="apellidos"
                                data-vv-as="apellidos"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-select
                                v-model="empleado.categoria_id"
                                v-validate="'required'"
                                :error-messages="errors.collect('categoria_id')"
                                label="Categoría"
                                data-vv-name="categoria_id"
                                data-vv-as="categoría"
                                :items="categorias"
                            ></v-select>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-spacer></v-spacer>
                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-btn @click="submit"  rounded  :loading="loading" small color="primary">
                                Guardar
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-card>
	</div>
</template>
<script>
    import moment from 'moment'
    import {mapGetters} from 'vuex';
    import MenuOpe from './MenuOpe'
    import Loading from '@/components/shared/Loading'

	export default {
		$_veeValidate: {
      		validator: 'new'
    	},
        components: {
            'menu-ope': MenuOpe,
            'loading': Loading

		},
    	data () {
      		return {
                empleado: {
                    id:       0,
                    nombre: null,
                    apellidos: null,
                    categoria_id: null
                },

                titulo: "Nuevo Empleado",
                categorias: [],

                loading: true,

      		}
        },
        mounted(){

            axios.get('/mto/empleados/create')
                .then(res => {
                    this.categorias = res.data.categorias;
                })
                .catch(err => {
                     if (err.response.status != 401){
                        this.$toast.error(err.response.data.message);
                        this.$router.push({ name: 'empleado.index'});
                        }
                })
                .finally(()=>{
                     this.loading = false;
                });
        },
        computed: {
            ...mapGetters([
	    		'isAdmin'
    		]),
            computedFModFormat() {
                moment.locale('es');
                return this.empleado.updated_at ? moment(this.empleado.updated_at).format('D/MM/YYYY H:mm') : '';
            },
            computedFCreFormat() {
                moment.locale('es');
                return this.empleado.created_at ? moment(this.empleado.created_at).format('D/MM/YYYY H:mm') : '';
            },

        },
    	methods:{
            submit() {
                if (this.loading === false){
                    this.loading = true;

                    var url = "/mto/empleados";

                    this.$validator.validateAll().then((result) => {
                        if (result){
                            axios.post(url, this.empleado)
                                .then(res => {

                                    this.$router.push({ name: 'empleado.edit', params: { id: res.data.registro.id } })
                                })
                                .catch(err => {
                                        const msg_valid = err.response.data.errors;
                                        for (const prop in msg_valid) {
                                            this.errors.add({
                                                field: prop,
                                                msg: `${msg_valid[prop]}`
                                            })
                                        }
                                })
                                .finally(()=>{
                                    this.loading = false;
                                });
                            }
                        else{
                            this.loading = false;
                        }
                    });
                }

            },
    }
  }
</script>
