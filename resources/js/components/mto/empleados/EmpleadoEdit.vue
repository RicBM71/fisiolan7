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
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.colegiado"
                                v-validate="'numeric'"
                                :error-messages="errors.collect('colegiado')"
                                label="Colegiado"
                                data-vv-name="colegiado"
                                data-vv-as="colegiado"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.cif"
                                v-validate="'alpha_num'"
                                :error-messages="errors.collect('cif')"
                                label="Cif"
                                data-vv-name="cif"
                                data-vv-as="cif"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.numero_ss"
                                v-validate="'alpha_dash'"
                                :error-messages="errors.collect('numero_ss')"
                                label="Número SS"
                                data-vv-name="numero_ss"
                                data-vv-as="numero_ss"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-select
                                v-model="empleado.categoria_id"
                                v-validate="'required'"
                                :error-messages="errors.collect('categoria_id')"
                                label="Categoría"
                                data-vv-name="categoria_id"
                                data-vv-as="categoria"
                                :items="categorias"
                            ></v-select>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col
                            cols="12"
                            md="3"
                        >
                            <v-text-field
                                v-model="empleado.direccion"
                                v-validate="'max:50'"
                                :error-messages="errors.collect('direccion')"
                                label="Dirección"
                                data-vv-name="direccion"
                                data-vv-as="direccion"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.cpostal"
                                v-validate="'max:5'"
                                :error-messages="errors.collect('cpostal')"
                                label="CP"
                                data-vv-name="cpostal"
                                data-vv-as="cpostal"
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
                                v-model="empleado.poblacion"
                                v-validate="'max:50'"
                                :error-messages="errors.collect('poblacion')"
                                label="Poblacion"
                                data-vv-name="poblacion"
                                data-vv-as="poblacion"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.provincia"
                                v-validate="'max:50'"
                                :error-messages="errors.collect('provincia')"
                                label="Provincia"
                                data-vv-name="provincia"
                                data-vv-as="provincia"
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
                                v-model="empleado.email"
                                v-validate="'email'"
                                :error-messages="errors.collect('email')"
                                label="email"
                                data-vv-name="email"
                                data-vv-as="email"
                                v-on:keyup.enter="submit"
                                required
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
                                v-validate="'required'"
                                :error-messages="errors.collect('alias')"
                                label="Alias"
                                data-vv-name="alias"
                                data-vv-as="alias"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="computedFechaNac"
                                mask="##/##/####"
                                clearable
                                @click:clear="clearFechaNac"
                                :error-messages="errors.collect('fecha_nacimiento')"
                                label="F. Nacimiento"
                                data-vv-name="fecha_nac"
                                v-on:keyup.enter="submit"                                    >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.telefonom"
                                v-validate="'numeric|max:10'"
                                :error-messages="errors.collect('telefonom')"
                                label="Móvil"
                                data-vv-name="telefonom"
                                data-vv-as="telefonom"
                                v-on:keyup.enter="submit"
                                required
                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.telefono1"
                                v-validate="'numeric|max:10'"
                                :error-messages="errors.collect('telefono1')"
                                label="Teléfono"
                                data-vv-name="telefono1"
                                data-vv-as="telefono1"
                                v-on:keyup.enter="submit"

                            >
                            </v-text-field>
                        </v-col>

                        <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.telefono2"
                                v-validate="'numeric|max:10'"
                                :error-messages="errors.collect('telefono2')"
                                label="Teléfono 2"
                                data-vv-name="telefono2"
                                data-vv-as="telefono2"
                                v-on:keyup.enter="submit"

                            >
                            </v-text-field>
                        </v-col>
                         <v-col
                            cols="12"
                            md="1"
                        >
                            <v-text-field
                                v-model="empleado.orden"
                                v-validate="'numeric'"
                                :error-messages="errors.collect('orden')"
                                label="Orden"
                                data-vv-name="orden"
                                data-vv-as="orden"
                                v-on:keyup.enter="submit"

                            >
                            </v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="2"
                        >
                            <v-text-field
                                v-model="empleado.fecha_baja"
                                :error-messages="errors.collect('fecha_baja')"
                                label="Fecha Baja"
                                data-vv-name="fecha_baja"
                                data-vv-as="fecha_baja"
                                v-on:keyup.enter="submit"
                                readonly
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
                                :error-messages="errors.collect('iban')"
                                label="IBAN"
                                counter=24
                                data-vv-name="iban"
                                v-on:keyup.enter="submit"
                            >
                            </v-text-field>
                        </v-col>

                        <v-col cols="12" md="2">
                            <v-text-field
                                v-model="empleado.username"
                                label="Usuario"
                                readonly
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-text-field
                                v-model="computedFModFormat"
                                label="Modificado"
                                readonly
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-text-field
                                v-model="computedFCreFormat"
                                label="Creado"
                                readonly
                            >
                            </v-text-field>
                        </v-col>

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
                empleado: {},
                loading: true,
                categorias:[]
      		}
        },
        beforeMount(){
            var id = this.$route.params.id;

            if (id > 0)
                axios.get('/mto/empleados/'+id+'/edit')
                    .then(res => {
                        this.empleado = res.data.registro;
                        this.categorias = res.data.categorias;
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
            computedFechaNac: {
                // getter
                get: function () {
                  moment.locale('es');
                    return this.empleado.fecha_nacimiento ? moment(this.empleado.fecha_nacimiento).format('DD/MM/YYYY') : '';
                },
                // setter
                set: function (newValue) {

                    if ( newValue != null && newValue.length == 8 ){
                            var f = newValue.substring(4,8)+"-"+
                                    newValue.substring(2,4)+"-"+
                                    newValue.substring(0,2);

                        this.empleado.fecha_nacimiento = f;
                    }
                }
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
    	methods:{
            submit() {

                if (this.loading === false){
                    this.loading = true;
                    var url = "/mto/empleados/"+this.empleado.id;
                    this.$validator.validateAll().then((result) => {
                        if (result){
                            axios.put(url, this.empleado)
                                .then(res => {
                                    this.$toast.success(res.data.message);
                                    this.empleado = res.data.registro;
                                })
                                .catch(err => {

                                    if (err.request.status == 422){ // fallo de validated.
                                        const msg_valid = err.response.data.errors;
                                        for (const prop in msg_valid) {
                                            this.errors.add({
                                                field: prop,
                                                msg: `${msg_valid[prop]}`
                                            })
                                        }
                                    }else{
                                        this.$toast.error(err.response.data.message);
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
            clearFechaNac(){
                this.empleado.fecha_nacimiento = null;

            },

    }
  }
</script>
<style scoped>

.inputNumber >>> input {
  text-align: center;
  -moz-appearance:textfield;
}

</style>
