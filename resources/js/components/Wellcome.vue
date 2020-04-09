<template>
<div id="app">
  <v-app>
    <v-app-bar
      app
      color="white"
      height="100"
    >
      <v-avatar
        class="mr-3"

        size="70"
      >
        <v-img
          contain
          max-height="70%"
          src="assets/logo.png"
        ></v-img>
      </v-avatar>

        <v-toolbar-title class="font-weight-black headline teal--text accent-2">
            Centro de fisioterapia Sanaval
        </v-toolbar-title>
        <!-- <v-spacer />
        <v-btn v-if="!isLoggedIn" icon v-on:click="login">
            <v-icon>mdi-account</v-icon>
        </v-btn>
        <v-btn v-else icon :to="{name: 'dash'}">
            <v-icon>desktop_windows</v-icon>
        </v-btn> -->
    </v-app-bar>

    <v-content>
      <section id="hero">
        <v-row no-gutters>
          <v-img
            :min-height="'calc(100vh - ' + $vuetify.application.top + 'px)'"
            src="assets/services-01-870x440.jpg"
          >
            <v-theme-provider dark>
              <v-container fill-height>
                <v-row
                  align="center"
                  class="purple--text mx-auto"
                  justify="center"
                >
                  <v-col
                    class="purple--text text-center"
                    cols="12"
                    tag="h1"
                  >
                    <span
                      class="font-weight-light"
                      :class="[$vuetify.breakpoint.smAndDown ? 'display-1' : 'display-2']"
                    >
                      Bienvenid@ a Sanaval
                    </span>

                    <br>

                    <span
                      :class="[$vuetify.breakpoint.smAndDown ? 'display-3': 'display-4']"
                      class="font-weight-ligth"
                    >
                      tu centro de fisioterapia
                    </span>

                  </v-col>

                  <v-btn
                    class="align-self-end purple--text"
                    fab
                    outlined
                    @click="$vuetify.goTo('#about-me')"
                  >
                    <v-icon>mdi-chevron-double-down</v-icon>
                  </v-btn>
                </v-row>
              </v-container>
            </v-theme-provider>
          </v-img>
        </v-row>
      </section>

      <section id="about-me">
        <div class="py-12"></div>

        <v-container class="text-center">
          <h2 class="display-2 font-weight-bold red--text darken-4 mb-3">AVISO IMPORTANTE</h2>

          <v-responsive
            class="mx-auto mb-8"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>

          <v-responsive
            class="mx-auto title font-weight-light mb-8 text-justify"
            max-width="920"
          >
            <p>El Centro de fisioterapia Sanaval, en el marco de las medidas de prevención y contención necesarias para la vigilancia y control en materia de salud pública de cara a la situación y evolución del coronavirus (COVID-19), hemos decidido suspender la actividad en nuestro centro.</p>
            <br/>
            <p>Con el fin de dar repuesta a cualquier duda podéis contactar con nosotros en el teléfono <span class="font-weight-bold">91 739 87 08</span>, por WhatsApp <span class="font-weight-bold">634 234 815</span>, o por email <span class="font-weight-bold">info@sanaval.com</span></p>
            <br />
            <p>Te recordamos que es muy importante:</p>
                <p><span class="font-weight-bold">#LavarseLasManos</span> con frecuencia.</p>
                <p><span class="font-weight-bold">#QuedarseEnCasa</span> y reducir el contacto social.</p>
                <p><span class="font-weight-bold">#YoMeMuevoEnCasa</span>, mantener la actividad física.</p>
            <p>Lamentamos las molestias ocasionadas y gracias por confiar en nosotros.</p>
          </v-responsive>

          <v-avatar
            class="elevation-12 mb-12"
            size="128"
          >
            <v-img src="assets/sara-110x110.jpg"></v-img>
          </v-avatar>
            <p>Sara Veiga Sánchez - Col. 1237</p>
          <div></div>

          <!-- <v-btn
            color="grey"
            href="https://vuetifyjs.com"
            outlined
            large
          >
            <span class="grey--text text--darken-1 font-weight-bold">
              Vuetify Documentation
            </span>
          </v-btn> -->
        </v-container>

        <div class="py-12"></div>
      </section>

      <section
        id="features"
        class="grey lighten-3"
      >
        <div class="py-12"></div>

        <v-container class="text-center">
          <h2 class="display-2 font-weight-bold mb-3">NUESTRO CENTRO</h2>

          <v-responsive
            class="mx-auto mb-12"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>

          <v-row>
            <v-col
              v-for="({ icon, title, text }, i) in features"
              :key="i"
              cols="12"
              md="4"
            >
              <v-card
                class="py-12 px-4"
                color="grey lighten-5"
                text
              >
                <v-theme-provider dark>
                  <div>
                    <v-avatar
                      color="primary"
                      size="88"
                    >
                      <v-icon
                        large
                        v-text="icon"
                      ></v-icon>
                    </v-avatar>
                  </div>
                </v-theme-provider>

                <v-card-title
                  class="justify-center font-weight-black text-uppercase"
                  v-text="title"
                ></v-card-title>

                <v-card-text
                  class="subtitle-1"
                  v-text="text"
                >
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>

        <div class="py-12"></div>
      </section>

      <section id="stats">
        <v-parallax
          :height="$vuetify.breakpoint.smAndDown ? 700 : 500"
          src="assets/background-03-1920x610.jpg"
        >
          <v-container fill-height>
            <v-row class="mx-auto">
              <v-col
                v-for="[value, title] of stats"
                :key="title"
                cols="12"
                md="3"
              >
                <div class="text-center">
                  <div
                    class="display-3 font-weight-black mb-4"
                    v-text="value"
                  ></div>

                  <div
                    class="title font-weight-regular text-uppercase"
                    v-text="title"
                  ></div>
                </div>
              </v-col>
            </v-row>
          </v-container>
        </v-parallax>
      </section>

      <section id="blog">
        <div class="py-12"></div>

        <v-container>
          <h2 class="display-2 font-weight-bold mb-3 text-uppercase text-center">Nuestros tratamientos</h2>

          <v-responsive
            class="mx-auto mb-12"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>

          <v-row>
            <v-col
              v-for="({ src, text, title }, i) in articles"
              :key="i"
              cols="12"
              md="4"
            >
              <v-img
                :src="src"
                class="mb-4"
                height="275"
                max-width="100%"
              ></v-img>

              <h3
                class="font-weight-black mb-4 text-uppercase"
                v-text="title"
              ></h3>

              <div
                class="title font-weight-light mb-5 text-justify"
                v-text="text"
              ></div>

              <!-- <v-btn
                class="ml-n4 font-weight-black"
                text
              >
                Continue Reading
              </v-btn> -->
            </v-col>
          </v-row>
        </v-container>

        <div class="py-12"></div>
      </section>

      <v-sheet
        id="contact"
        color="#FFF"
        tag="section"
        tile
      >
        <div class="py-12"></div>

        <v-container>
          <h2 class="display-2 font-weight-bold mb-3 text-uppercase text-center black--text">Contacto</h2>

          <v-responsive
            class="mx-auto mb-12"
            width="56"
          >
            <v-divider class="mb-1"></v-divider>

            <v-divider></v-divider>
          </v-responsive>

          <v-row>
            <v-col cols="12" lg="4" md="6" sm="12">
                <v-card flat>
                    <h4 class="title font-weight-bold mb-3">Horario</h4>
                    <p>Lunes a Viernes de 10 a 14h y de 16:30 a 20:30</p>
                    <h4 class="subtitle-2 font-weight-bold mb-3">Solicita Cita Previa: </h4>
                    <v-row>
                      <v-col cols="10">
                        <h4 class="subtitle-2 font-weight-bold mb-3">
                          <v-icon class="purple--text">mdi-phone-classic</v-icon> 917398708
                        </h4>
                      </v-col>
                      <v-col cols="10">
                        <h4 class="subtitle-2 font-weight-bold mb-3">
                          <v-icon class="green--text">mdi-whatsapp</v-icon> WhatsApp 634234815
                        </h4>
                      </v-col>
                      <v-col cols="10">
                        <h4 class="subtitle-2 font-weight-bold mb-3">
                          <v-icon class="gray--text">mdi-email</v-icon> info@sanaval.com
                        </h4>
                      </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <p class="caption font-italic font-weight-light red--text">* Suspendido temporalmente el servicio de citas online</p>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
            <v-col cols="8" lg="3" sm="8">
              <v-card flat>
                  <h4 class="title font-weight-bold mb-3">Dónde estamos</h4>
                  <div class="subtitle-2">Av de Betanzos, 10 Posterior</div>
                  <div class="subtitle-2">28029 Madrid</div>
                   <v-btn icon v-on:click="goMaps" >
                        <v-icon color="green" flat>mdi-google-maps</v-icon>
                    </v-btn>
                        Google Maps
                  <br/>
              </v-card>
            </v-col>
            <v-col cols="12" lg="3" sm="8">
                <v-card flat>
                    <h4 class="title font-weight-bold mb-3">Acreditados</h4>
                  <div class="subtitle-2">Profesionales Colegiados</div>
                  <div class="subtitle-2">Autorizado por la Consejería de Sanidad de la CCMM</div>
                  <div class="subtitle-2">Centro Nº 3303</div>
                  <br/>
                  <v-row>
                  <v-col cols="6" lg="3">
                    <v-img
                        contain
                        position="left center"
                        aspect-ratio="1"
                        src="assets/partner-02-150x135.png"
                    ></v-img>
                  </v-col>
                  <v-col cols="6" lg="3">
                     <v-img
                        contain
                        position="left center"
                        aspect-ratio="1"
                        src="assets/partner-01-150x79.png"
                    ></v-img>
                  </v-col>
                  </v-row>
              </v-card>
            </v-col>
        </v-row>



          <!-- <v-theme-provider light>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  flat
                  label="Name*"
                  solo
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  flat
                  label="Email*"
                  solo
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  flat
                  label="Subject*"
                  solo
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-textarea
                  flat
                  label="Message*"
                  solo
                ></v-textarea>
              </v-col>

              <v-col
                class="mx-auto"
                cols="auto"
              >
                <v-btn
                  color="accent"
                  x-large
                >
                  Submit
                </v-btn>
              </v-col>
            </v-row>
          </v-theme-provider> -->
        </v-container>

        <div class="py-12"></div>
      </v-sheet>
    </v-content>
      <v-alert
              v-model="alert"
              dismissible
              color="cyan"
              elevation="2"
              colored-border
              >
              <div class="caption text-center">
                Utilizamos cookies propias y de terceros para mejorar nuestros servicios mediante el análisis de sus hábitos de navegación. Puede obtener más información <strong><a v-on:click="showLegal()">aquí</a></strong>.
              </div>
          </v-alert>

         <v-sheet
            v-if="legal"
            id="contact"
            color="#FFF"
            tag="section"
            tile
        >
            <div class="py-12"></div>

            <v-container>
            <h2 class="display-2 font-weight-bold mb-3 text-uppercase text-center black--text">Aviso Legal</h2>
            <v-row>
                <v-col cols="12">
                    <p>El presente aviso legal recoge las condiciones generales que rigen el acceso y el uso del sitio web, www.sanaval.com</p>
                    <div class="title">CONDICIONES GENERALES</div>
                    <div class="caption text-justify">
                        <p>En cumplimiento con el deber de información recogido en artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico (LSSICE), el propietario de la web , le informa de lo siguiente:</p>
                            <p>Denominación social: Centro de Fisioterapia Sanaval, S.L.</p>
                            <p>Domicilio: Avenida de Betanzos, 10, Posterior, 28029 - Madrid</p>
                            <p>Autorización administrativa Consejería de sanidad de la CCMM : CS3303</p>
                            <p>Con los límites establecidos en la ley, Centro de Fisioterapia Sanaval, S.L. no asume ninguna responsabilidad derivada de la falta de veracidad, integridad, actualización y precisión de los datos o informaciones que contienen sus páginas web.
                                Los contenidos e información no vinculan a Centro de Fisioterapia Sanaval, S.L. ni constituyen opiniones, consejos o asesoramiento legal de ningún tipo pues se trata meramente de un servicio ofrecido con carácter informativo y divulgativo.
                                Las páginas de Internet de Centro de Fisioterapia Sanaval, S.L. pueden contener enlaces (links) a otras páginas de terceras partes que Centro de Fisioterapia Sanaval, S.L. no puede controlar. Por lo tanto, Centro de Fisioterapia Sanaval, S.L. no puede asumir responsabilidades por el contenido que pueda aparecer en páginas de terceros.
                                Los textos, imágenes, sonidos, animaciones, software y el resto de contenidos incluidos en este website son propiedad exclusiva de Centro de Fisioterapia Sanaval, S.L. o sus licenciantes. Cualquier acto de transmisión, distribución, cesión, reproducción, almacenamiento o comunicación pública total o parcial, deberá contar con el consentimiento expreso de Centro de Fisioterapia Sanaval, S.L..
                                Asimismo, para acceder a algunos de los servicios que Centro de Fisioterapia Sanaval, S.L. ofrece a través del sitio web, deberá proporcionar algunos datos de carácter personal. En cumplimiento de lo establecido en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos le informamos que, mediante la cumplimentación de los presentes formularios, sus datos personales quedarán incorporados y serán tratados en los ficheros de Centro de Fisioterapia Sanaval, S.L. con el fin de poderle prestar y ofrecer nuestros servicios así como para informarle de las mejoras del sitio Web.
                                Le informamos también de que tendrá la posibilidad en todo momento de ejercer los derechos de acceso, rectificación, cancelación, oposición, limitación y portabilidad de sus datos de carácter personal, de manera gratuita mediante email a: info@sanaval.com o en la dirección: Avenida de Betanzos, 10, Posterior, 28029 - Madrid.
                        </p>
                    </div>
                    <div class="caption text-justify">
                        <p>El acceso y uso del sitio web implica la expresa y plena aceptación de están condiciones generales en la versión publicada en el momento en que el usuario acceda, sin perjuicio de las condiciones particulares que pudieran aplicarse en algunos de los servicios concretos del sitio web.
                            El usuario acepta que el acceso al presente sitio web y los contenidos incluidos en el mismo tiene lugar libre conscientemente, bajo su exclusiva responsabilidad. Los usuarios acceden al sitio web de forma libre y gratuita, aunque el Centro de fisioterapia Sanaval se reserva el derecho de limitar su acceso para determinados contenidos o servicios, exigiendo el registro de sus datos previamente al acceso.
                            Sanaval se reserva el derecho a modificar en cualquier momento la presentación, configuración y localización del sitio web, así como los contenidos, servicios y las condiciones requeridas para utilizar los mismos cuando lo considere oportuno o con la finalidad de adecuarse a los cambios legislativos y tecnológicos futuros. Estas modificaciones serán válidas desde su publicación en el sitio web.
                            Sanaval se reserva el derecho a interrumpir el acceso al presente sitio web en cualquier momento y sin previo aviso, ya sea por motivos técnicos, de seguridad, de control, de mantenimiento, por fallos de suministro eléctrico, o por cualquier otra causa. Esta interrupción podrá tener carácter temporal o definitivo, en este caso se comunicará tal circunstancia a los usuarios, quienes podrán sufrir la pérdida, en su caso, de la información almacenada en los diferentes servicios, sin dar lugar a indemnización alguna.
                            Sanaval se compromete a no remitir comunicaciones comerciales sin identificarlas como tales, conforme a lo dispuesto en la Ley 34/2002 de Servicios de la Sociedad de la Información y de Comercio Electrónico. A estos efectos no será considerado como comunicación comercial toda la información que se envíe a los clientes de nombre y de la empresa siempre que tenga por finalidad el mantenimiento de la relación contractual existente entre cliente y nombre de la empresa, así como el desempeño de las tareas de información, formación y otras actividades propias del servicio que el cliente tiene contratado con la empresa.
                        </p>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <div class="title">PRIVACIDAD</div>
                        <p class="caption text-justify">
                            Centro de Fisioterapia Sanaval, S.L., en aplicación de la normativa vigente en materia de protección de datos de carácter personal, informa que los datos personales que se recogen a través de los formularios del Sitio web: https://sanaval.com, se incluyen en los ficheros automatizados específicos de usuarios de los servicios de Centro de Fisioterapia Sanaval, S.L.
                            La recogida y tratamiento automatizado de los datos de carácter personal tiene como finalidad el mantenimiento de la relación comercial y el desempeño de tareas de información, formación, asesoramiento y otras actividades propias de Centro de Fisioterapia Sanaval, S.L.
                            Estos datos únicamente serán cedidos a aquellas entidades que sean necesarias con el único objetivo de dar cumplimiento a la finalidad anteriormente expuesta.
                            Centro de Fisioterapia Sanaval, S.L. adopta las medidas necesarias para garantizar la seguridad, integridad y confidencialidad de los datos conforme a lo dispuesto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de los mismos, y derogando la antigua LOPD, la nueva Ley Orgánica 3/2018, de 5 diciembre, de Protección de Datos y Garantía de los Derechos Digitales (LOPDGDD).
                            El usuario podrá en cualquier momento ejercitar los derechos de acceso, oposición, rectificación, cancelación, limitación y portabilidad reconocidos en el citado Reglamento (UE). El ejercicio de estos derechos puede realizarlo el propio usuario a través de email a: rbartolome@sanaval.com o en la dirección: Avenida de Betanzos, 10, Posterior, C.P. 28029 - Madrid (Madrid).
                            El usuario manifiesta que todos los datos facilitados por él son ciertos y correctos, y se compromete a mantenerlos actualizados, comunicando los cambios a Centro de Fisioterapia Sanaval, S.L.
                        </p>
                        <div class="subtitle-1">
                            Finalidad del tratamiento de los datos personales: ¿Con qué finalidad trataremos tus datos personales?
                        </div>
                        <p class="caption text-justify">
                            En Centro de Fisioterapia Sanaval, S.L., trataremos tus datos personales recabados a través del Sitio Web: https://sanaval.com, con las siguientes finalidades:
                            Prestar sus servicios de acuerdo con las necesidades particulares de los clientes, con el fin de cumplir los contratos suscritos por la misma.
                            El proceso de archivo, de actualización de los sistemas, de protección y custodia de información y bases de datos de la empresa.
                            Prestar los servicios contratados por el usuario.
                            Te recordamos que puedes oponerte al envío de comunicaciones comerciales por cualquier vía y en cualquier momento, remitiendo un correo electrónico a la dirección anteriormente indicada.
                            Los campos de dichos registros son de cumplimentación obligatoria, siendo imposible realizar las finalidades expresadas si no se aportan esos datos.
                        </p>
                        <div class="subtitle-1">
                            ¿Por cuánto tiempo se conservan los datos personales recabados?
                        </div>
                        <p class="caption text-justify">
                            Los datos personales proporcionados se conservarán mientras se mantenga la relación comercial o no solicites su supresión y durante el plazo por el cuál pudieran derivarse responsabilidades legales por los servicios prestados.
                        </p>
                        <div class="subtitle-1">
                            Legitimación:
                        </div>
                        <p class="caption text-justify">
                            El tratamiento de tus datos se realiza con las siguientes bases jurídicas que legitiman el mismo:
                            La solicitud de información y/o la contratación de los servicios de Centro de Fisioterapia Sanaval, S.L., cuyos términos y condiciones se pondrán a tu disposición en todo caso, de forma previa a una eventual contratación.
                            El consentimiento libre, específico, informado e inequívoco, en tanto que te informamos poniendo a tu disposición la presente política de privacidad, que tras la lectura de la misma, en caso de estar conforme, puedes aceptar mediante una declaración o una clara acción afirmativa, como el marcado de una casilla dispuesta al efecto.
                            En caso de que no nos facilites tus datos o lo hagas de forma errónea o incompleta, no podremos atender tu solicitud, resultando del todo imposible proporcionarte la información solicitada o llevar a cabo la contratación de los servicios.
                        </p>
                        <p class="caption text-justify">
                            Destinatarios:
                            Los datos no se comunicarán a ningún tercero ajeno a Centro de Fisioterapia Sanaval, S.L., salvo obligación legal.

                            Datos recopilados por usuarios de los servicios
                            En los casos en que el usuario incluya ficheros con datos de carácter personal en los servidores de alojamiento compartido, Centro de Fisioterapia Sanaval, S.L. no se hace responsable del incumplimiento por parte del usuario del RGPD.

                            Retención de datos en conformidad a la LSSI
                            Centro de Fisioterapia Sanaval, S.L. informa de que, como prestador de servicio de alojamiento de datos y en virtud de lo establecido en la Ley 34/2002 de 11 de julio de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSI), retiene por un periodo máximo de 12 meses la información imprescindible para identificar el origen de los datos alojados y el momento en que se inició la prestación del servicio. La retención de estos datos no afecta al secreto de las comunicaciones y sólo podrán ser utilizados en el marco de una investigación criminal o para la salvaguardia de la seguridad pública, poniéndose a disposición de los jueces y/o tribunales o del Ministerio que así los requiera. La comunicación de datos a las Fuerzas y Cuerpos del Estado se hará en virtud a lo dispuesto en la normativa sobre protección de datos personales.
                        </p>
                        <p class="caption text-justify">
                            Derechos propiedad intelectual https://sanaval.com
                            Centro de Fisioterapia Sanaval, S.L. es titular de todos los derechos de autor, propiedad intelectual, industrial, "know how" y cuantos otros derechos guardan relación con los contenidos del sitio web https://sanaval.com y los servicios ofertados en el mismo, así como de los programas necesarios para su implementación y la información relacionada.

                            No se permite la reproducción, publicación y/o uso no estrictamente privado de los contenidos, totales o parciales, del sitio web https://sanaval.com sin el consentimiento previo y por escrito.

                            Propiedad intelectual del software
                            El usuario debe respetar los programas de terceros puestos a su disposición por Centro de Fisioterapia Sanaval, S.L., aún siendo gratuitos y/o de disposición pública.

                            Centro de Fisioterapia Sanaval, S.L. dispone de los derechos de explotación y propiedad intelectual necesarios del software.

                            El usuario no adquiere derecho alguno o licencia por el servicio contratado, sobre el software necesario para la prestación del servicio, ni tampoco sobre la información técnica de seguimiento del servicio, excepción hecha de los derechos y licencias necesarios para el cumplimiento de los servicios contratados y únicamente durante la duración de los mismos.

                            Para toda actuación que exceda del cumplimiento del contrato, el usuario necesitará autorización por escrito por parte de Centro de Fisioterapia Sanaval, S.L., quedando prohibido al usuario acceder, modificar, visualizar la configuración, estructura y ficheros de los servidores propiedad de Centro de Fisioterapia Sanaval, S.L., asumiendo la responsabilidad civil y penal derivada de cualquier incidencia que se pudiera producir en los servidores y sistemas de seguridad como consecuencia directa de una actuación negligente o maliciosa por su parte.

                            Propiedad intelectual de los contenidos alojados
                            Se prohíbe el uso contrario a la legislación sobre propiedad intelectual de los servicios prestados por Centro de Fisioterapia Sanaval, S.L. y, en particular de:

                            La utilización que resulte contraria a las leyes españolas o que infrinja los derechos de terceros.
                            La publicación o la transmisión de cualquier contenido que, a juicio de Centro de Fisioterapia Sanaval, S.L., resulte violento, obsceno, abusivo, ilegal, racial, xenófobo o difamatorio.
                            Los cracks, números de serie de programas o cualquier otro contenido que vulnere derechos de la propiedad intelectual de terceros.
                            La recogida y/o utilización de datos personales de otros usuarios sin su consentimiento expreso o contraviniendo lo dispuesto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de los mismos.
                            La utilización del servidor de correo del dominio y de las direcciones de correo electrónico para el envío de correo masivo no deseado.
                            El usuario tiene toda la responsabilidad sobre el contenido de su web, la información transmitida y almacenada, los enlaces de hipertexto, las reivindicaciones de terceros y las acciones legales en referencia a propiedad intelectual, derechos de terceros y protección de menores.

                            El usuario es responsable respecto a las leyes y reglamentos en vigor y las reglas que tienen que ver con el funcionamiento del servicio online, comercio electrónico, derechos de autor, mantenimiento del orden público, así como principios universales de uso de Internet.

                            El usuario indemnizará a Centro de Fisioterapia Sanaval, S.L. por los gastos que generara la imputación de Centro de Fisioterapia Sanaval, S.L. en alguna causa cuya responsabilidad fuera atribuible al usuario, incluidos honorarios y gastos de defensa jurídica, incluso en el caso de una decisión judicial no definitiva.

                            Protección de la información alojada
                            Centro de Fisioterapia Sanaval, S.L. realiza copias de seguridad de los contenidos alojados en sus servidores, sin embargo no se responsabiliza de la pérdida o el borrado accidental de los datos por parte de los usuarios. De igual manera, no garantiza la reposición total de los datos borrados por los usuarios, ya que los citados datos podrían haber sido suprimidos y/o modificados durante el periodo del tiempo transcurrido desde la última copia de seguridad.

                            Los servicios ofertados, excepto los servicios específicos de backup, no incluyen la reposición de los contenidos conservados en las copias de seguridad realizadas por Centro de Fisioterapia Sanaval, S.L., cuando esta pérdida sea imputable al usuario; en este caso, se determinará una tarifa acorde a la complejidad y volumen de la recuperación, siempre previa aceptación del usuario.

                            La reposición de datos borrados sólo está incluida en el precio del servicio cuando la pérdida del contenido sea debida a causas atribuibles a Centro de Fisioterapia Sanaval, S.L..
                        </p>
                        <div class="subtitle-1">
                            Comunicaciones comerciales
                        </div>
                        <p class="caption text-justify">
                            En aplicación de la LSSI. Centro de Fisioterapia Sanaval, S.L. no enviará comunicaciones publicitarias o promocionales por correo electrónico u otro medio de comunicación electrónica equivalente que previamente no hubieran sido solicitadas o expresamente autorizadas por los destinatarios de las mismas.
                            En el caso de usuarios con los que exista una relación contractual previa, Centro de Fisioterapia Sanaval, S.L. sí está autorizado al envío de comunicaciones comerciales referentes a productos o servicios de Centro de Fisioterapia Sanaval, S.L. que sean similares a los que inicialmente fueron objeto de contratación con el cliente.
                            En todo caso, el usuario, tras acreditar su identidad, podrá solicitar que no se le haga llegar más información comercial a través de los canales de Atención al Cliente.

                        </p>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                     <v-btn @click="closeLegal()" text small>Cerrar</v-btn>
                </v-col>
            </v-row>

            </v-container>
         </v-sheet>
    <v-footer
      class="justify-center"
      color="#292929"
      height="100"
    >




      <div class="caption font-weight-light grey--text text--lighten-1 text-center">
        &copy; {{ (new Date()).getFullYear() }} — Centro de fisioterapia Sanaval SL. Av de Betanzos, 10 Posterior 28029 Madrid.
      </div>
    </v-footer>
  </v-app>
 </div>
</template>
<script>
import {mapGetters} from 'vuex';
	export default {
        computed:{
            ...mapGetters([
				'isLoggedIn'
            ]),
            computedColorTitulo(){
                if (this.empresa.img1 == null)
                    return "black--text";
                else
                    return "white--text";
            }
        },
        data: () => ({
            alert: true,
            legal: false,
            empresa: {},
            articles: [
                {
                    src: 'assets/gallery-05-370x240.jpg',
                    title: 'Tratamientos',
                    text: "Disponemos esencialmente de dos tipos de tramiento: uno combinado terapia + aparatología adaptada a tu lesión: microonda, corrientes, magnetoterapia, láser, etc. y otro únicamente manual. Siempre la base fundamental de nuestros tratamientos es la terapia manual. Nuestros fisioterapeutas darán respuesta y te orientarán acerca del tratamiento más adecuado para ti.",
                },
                {
                    src: 'assets/gallery/gallery-07-370x240.jpg',
                    title: 'Exclusividad',
                    text: "Todas las patologías requieren de un tiempo de recuperación y este va a depender de cada persona, de su trabajo, de su edad, muchos factores que van a influir decisivamente en cada persona. Nosotros solo te podemos garantizar nuestra absoluta entrega para tu rehabilitación. Todos nuestros tratamientos se adaptan individualmente a cada paciente, de acuerdo a su patología y a su edad."
                },
                {
                    src: 'assets/gallery/gallery-03-370x240.jpg',
                    title: 'Nuestros Mayores',
                    text: 'Queremos incidir especialmente en el factor de la edad porque consideramos un pilar fundamental de nuestra actividad el tratamiento a nuestros mayores, que en muchas ocasiones no obtienen respuestas a sus dolencias. Hay hay muchas soluciones adaptadas a personas mayores que mejorarán considerablemente su calidad de vida. Disponemos de precios especiales para mayores de 65 años.',
                },
                ],
                features: [
                {
                    icon: 'mdi-account-star',
                    title: 'Tú eres nuestra razón de ser',
                    text: 'Desde el año 2001, hemos entendido la fisioterapia como el medio para ayudar la comunidad, de forma comprometida, personalizada y adaptada a tu patología. Nos esforzamos y damos lo mejor de nostros mismos para que tu recuperación sea un hecho. Cuéntanos tu problema y nos comprometos a buscar la mejor solución a tu recuperación.',
                },
                {
                    icon: 'mdi-update',
                    title: 'Nuestros tratamientos',
                    text: 'En nuestro centro ofrecemos como norma general un tratamiento combinado, en primer lugar y como pilar fundamental la terapia manual, en el que un fisioterapeuta te valorará y te indicará las pautas de tu tratamiento. Complementario a la terapia manual, disponemos de equipos de electroterapia, magnetoterapia, láser, microonda, presoterapia, etc. ',
                },
                {
                    icon: 'mdi-account-group-outline',
                    title: 'Nuestro equipo',
                    text: 'Nuestro centro se compone de un equipo de fisioterapeutas altamente cualificados y están dispuestos a escucharte y dispensar el tratamiento más adecuado a tu patología. No hay soluciones milagrosas, la fisioterapia requiere de esfuerzo y compromiso por parte del fisioterapueta pero es fundamental la colaboración del paciente. Nosotros estamos dispuestos.',
                },
                ],
                stats: [
                ['+19 Años', 'Actividad'],
                ['+7000', 'Pacientes tratados'],
                ['1º', 'Tú eres lo primero'],
                ['+65', 'Descuentos a mayores'],
                ],

        }),
        beforeMount(){
            axios.get('api/emp')
                .then(res => {
                    this.empresa = res.data;
                })
                .catch(err => {
                    console.log(err);
            })
        },
        methods:{
            showLegal(){
              this.alert = false;
              this.legal = true;
            },
            closeLegal(){
              this.legal = false;
            },
            login(){
                window.location = '/login';
            },
            goMaps(){
                window.open('https://www.google.com/maps/place/Fisioterapia+Sanaval/@40.4749474,-3.7136945,17z/data=!4m12!1m6!3m5!1s0xd4229a297a7c8d7:0xa386654cca9e938a!2sFisioterapia+Sanaval!8m2!3d40.4728556!4d-3.711619!3m4!1s0xd4229a297a7c8d7:0xa386654cca9e938a!8m2!3d40.4728556!4d-3.711619');
            }
        }
	}
</script>
