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
                            <v-text-field
                                v-model="empleado.nombre"
                                label="Nombre"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-text-field
                                v-model="empleado.apellidos"
                                label="Apellidos"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.colegiado"
                                label="Colegiado"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.cif"
                                label="Cif"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.numero_ss"
                                label="Número SS"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.categoria.nombre"
                                label="Categoría"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-text-field
                                v-model="empleado.direccion"
                                label="Dirección"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.cpostal"
                                label="CP"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-text-field
                                v-model="empleado.poblacion"
                                label="Poblacion"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.provincia"
                                label="Provincia"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-text-field
                                v-model="empleado.email"
                                label="email"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                         <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.alias"
                                label="Alias"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="computedFechaNac"
                                label="F. Nacimiento"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.telefonom"
                                label="Móvil"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.telefono1"
                                label="Teléfono"
                                disabled
                            >
                            </v-text-field>
                        </v-col>

                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.telefono2"
                                label="Teléfono 2"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                         <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.orden"
                                label="Orden"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="computedFechaBaja"
                                label="Fecha Baja"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-color-picker
                                hide-canvas
                                hide-inputs
                                v-model="empleado.color"
                                flat
                            ></v-color-picker>
                        </v-col>
                    </v-row>
                    <v-row>

                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-text-field
                                v-model="empleado.iban"
                                label="IBAN"
                                disabled
                            >
                            </v-text-field>
                        </v-col>

                        <v-col cols="12" md="2">
                            <v-text-field
                                v-model="empleado.username"
                                label="Usuario"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-text-field
                                v-model="computedFModFormat"
                                label="Modificado"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-text-field
                                v-model="computedFCreFormat"
                                label="Creado"
                                disabled
                            >
                            </v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-card>
	</div>
</template>
<script>
import moment from 'moment'
import Loading from '@/components/shared/Loading'
import MenuOpe from './MenuOpe'

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
                titulo:"Empleado",
                empleado: { categoria:{nombre: ""}},
                loading: true,
      		}
        },
        beforeMount(){
            var id = this.$route.params.id;

            if (id > 0)
                axios.get('/mto/empleados/'+id)
                    .then(res => {
                        this.empleado = res.data.registro;
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.message);
                        this.$router.push({ name: 'empleado.index'})
                    })
                    .finally(()=>{
                       this.loading = false;
                });
        },
        computed: {
            computedFechaNac() {
                moment.locale('es');
                return this.empleado.fecha_nacimiento ? moment(this.empleado.fecha_nacimiento).format('D/MM/YYYY') : '';
            },
            computedFechaBaja() {
                moment.locale('es');
                return this.empleado.fecha_baja ? moment(this.empleado.fecha_baja).format('D/MM/YYYY') : '';
            },
            computedFModFormat() {
                moment.locale('es');
                return this.empleado.updated_at ? moment(this.empleado.updated_at).format('D/MM/YYYY H:mm:ss') : '';
            },
            computedFCreFormat() {
                moment.locale('es');
                return this.empleado.created_at ? moment(this.empleado.created_at).format('D/MM/YYYY H:mm:ss') : '';
            }

        },
    	methods:{}
  }
</script>
<style scoped>

.inputNumber >>> input {
  text-align: center;
  -moz-appearance:textfield;
}

</style>
