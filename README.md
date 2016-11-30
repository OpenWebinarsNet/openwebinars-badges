<!-- TOC depthFrom:1 depthTo:6 withLinks:1 updateOnSave:1 orderedList:0 -->

	- [¿Qué es un plugin?](#qu-es-un-plugin)
	- [Requisitos en el header](#requisitos-en-el-header)
	- [Licencia](#licencia)
	- [Acciones y filtros en WordPress](#acciones-y-filtros-en-wordpress)
	- [Ejemplo de Acciones y Filtros](#ejemplo-de-acciones-y-filtros)
	- [Mejores prácticas](#mejores-prcticas)
		- [Evitar colisiones de nombres](#evitar-colisiones-de-nombres)
			- [Procedural](#procedural)
				- [Prefijo en todos sitios](#prefijo-en-todos-sitios)
				- [Comprueba implementaciones existentes](#comprueba-implementaciones-existentes)
				- [Ejemplos:](#ejemplos)
			- [Programación Orientada a Objetos](#programacin-orientada-a-objetos)
			- [Organización de archivos](#organizacin-de-archivos)
				- [Estructura de carpetas](#estructura-de-carpetas)
		- [Arquitectura del plugin](#arquitectura-del-plugin)
			- [Carga condicional](#carga-condicional)
			- [Patrones de arquitectura](#patrones-de-arquitectura)
			- [Patrones de arquitecturas explicados](#patrones-de-arquitecturas-explicados)
			- [Puntos de partida](#puntos-de-partida)
	- [Comprobando las capacidades de usuario](#comprobando-las-capacidades-de-usuario)
		- [Roles de usuarios y capacidades](#roles-de-usuarios-y-capacidades)
			- [Herencia](#herencia)
			- [Ejemplos](#ejemplos)
				- [Sin restricciones](#sin-restricciones)
				- [Restringido a una capacidad específica](#restringido-a-una-capacidad-especfica)
	- [Validación de datos](#validacin-de-datos)
		- [Validando los datos](#validando-los-datos)
			- [Funciones de PHP](#funciones-de-php)
			- [Funciones de WordPress](#funciones-de-wordpress)
			- [Funciones de PHP y JavaScript personalizadas](#funciones-de-php-y-javascript-personalizadas)
			- [Ejemplo](#ejemplo)
	- [Securizando la entrada](#securizando-la-entrada)
		- [Saneando los datos](#saneando-los-datos)
		- [Ejemplo](#ejemplo)
	- [Securizando la salida](#securizando-la-salida)
		- [Escapado](#escapado)
		- [Escapado con Localización](#escapado-con-localizacin)
		- [Escapado personalizado](#escapado-personalizado)
	- [Nonces](#nonces)
		- [Usando Nonces](#usando-nonces)
		- [Ejemplo completo](#ejemplo-completo)
	- [Crear una página de configuración](#crear-una-pgina-de-configuracin)
	- [Añadir estilos a la página de configuración](#aadir-estilos-a-la-pgina-de-configuracin)
	- [Trabajando con formularios en la página de configuración](#trabajando-con-formularios-en-la-pgina-de-configuracin)
	- [Funciones básicas con la tabla wp_options](#funciones-bsicas-con-la-tabla-wpoptions)
	- [API de ajustes](#api-de-ajustes)
	- [API de opciones](#api-de-opciones)
	- [JSON como API](#json-como-api)
	- [Obteniendo y almacenando un feed JSON](#obteniendo-y-almacenando-un-feed-json)
	- [Parseando JSON con PHP](#parseando-json-con-php)
	- [Repaso a la OOP](#repaso-a-la-oop)
	- [Construyendo un plugin Orientado a Objetos](#construyendo-un-plugin-orientado-a-objetos)
	- [Documentando el plugin](#documentando-el-plugin)
	- [Herencia](#herencia)
	- [Cómo crear Widgets de WordPress](#cmo-crear-widgets-de-wordpress)
	- [Añadiendo ajustes a un Widget](#aadiendo-ajustes-a-un-widget)
	- [Añadiendo estilos personalizados a un Widget](#aadiendo-estilos-personalizados-a-un-widget)
	- [Añadiendo estilos personalizados a un Widget en el Front End](#aadiendo-estilos-personalizados-a-un-widget-en-el-front-end)
	- [Cómo crear un Shortcode](#cmo-crear-un-shortcode)
	- [Añadiendo AJAX a plugins en el Front End](#aadiendo-ajax-a-plugins-en-el-front-end)
	- [Metadatos](#metadatos)
	- [Custom Post Types](#custom-post-types)
	- [Taxonomías](#taxonomas)
	- [Usuarios](#usuarios)
	- [JavaScript en un plugin PHP](#javascript-en-un-plugin-php)
	- [Cron de WordPress](#cron-de-wordpress)
	- [Internacionalización del plugin](#internacionalizacin-del-plugin)
	- [El archivo Readme.txt](#el-archivo-readmetxt)
	- [Añadiendo el plugin al repositorio de WordPress](#aadiendo-el-plugin-al-repositorio-de-wordpress)
	- [Dar soporte y monetizar nuestro plugin](#dar-soporte-y-monetizar-nuestro-plugin)
	- [Herramientas para desarrolladores](#herramientas-para-desarrolladores)

<!-- /TOC -->

Cómo funciona un plugin de WordPress
======
## ¿Qué es un plugin?
Los plugins de WordPress son paquetes de código que extienden la funcionalidad de WordPress. Están hecho de código PHP y otros archivos como imágenes, estilos en CSS y código JavaScript.

Al crear tu propio plugin de WordPress estás extendiendo WordPress, construyendo una funcionalidad adicional encima de lo que WordPress ya ofrece. Por ejemplo, puedes escribir un plugin que muestre enlaces a las 10 entradas más recientes en tu sitio.

O, usando los tipos de publicación personalizada (Custom Post Types) puedes escribir un plugin que cree un sistema completo de soporte con tickets, notificaciones por e-mail, estados personalizados de los tickets y un portal de cara al cliente. ¡Las posibilidades no tienen límites!
La mayoría de los plugins de WordPress están compuestos de muchos archivos, pero un plugin sólo necesita un archivo principal con un comentario de tipo DocBlock en el header.

Hello Dolly es uno de los primeros plugins y solo tiene 82 líneas de código. Hello Dolly muestra las letras de la famosa canción en el escritorio de WordPress. Se usa un poco de CSS en el archivo PHP para controlar cómo lucen las letras.

Como autor de plugins de WordPress.org, tienes una increíble oportunidad para crear un plugin que pueda ser instalado y amado por millones de usuarios de WordPress. Todo lo que necesitas es convertir tus ideas en código.

## Requisitos en el header
Cómo se describió en la sección anterior, un comentario en la cabecera (header) is lo que le dirá a WordPress que un archivo es un plugin.

Como mínimo, un comentario de cabecera debe contener el nombre del plugin, pero puedes - y debes - incluir algunos datos más:

+ Plugin Name: El nombre del plugin, el cuál se mostrará en la lista de plugins en el admin de WordPress.
+ Plugin URI: La página de inicio del plugin, que debe estar en WordPress.org o en tu propio sitio web.
+ Description: Una descripción corta del plugin. Mantén esta descripción por debajo de los 140 caracteres.
+ Version: La versión actual de tu plugin. Nota que WordPress y la API de plugins usa la función version_compare() cuando considera los números de versiones: por ejemplo, 1.02 es mayor que 1.1.
+ Author: El nombre del autor del plugin. Si hay más de uno, sepáralos por coma.
+ Author URI: El sitio web del autor o su perfil en otro sitio web como el de WordPress.org.
+ License: El nombre corto de la licencia (slug), por ejemplo GPLD2.
+ License URI: Enlace para la licencia.
+ Text Domain: El text domain se usa para poder internacionalizar tu plugin, o traducirlo a otros idiomas. Usa el paquete gettext.
+ Domain Path: La ruta del dominio le indica a WordPress dónde encontrar las traducciones.

Así quedaría el código básico de la cabecera en un plugin de WordPress:

```
<?php
/**
 * Plugin Name: WordPress.org Plugin
 * Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
 * Description: Basic WordPress Plugin Header Comment
 * Version:     20160911
 * Author:      WordPress.org
 * Author URI:  https://developer.wordpress.org/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wporg
 * Domain Path: /languages
 */
```

## Licencia
Una parte muy importante del software es su licencia. La mayoría de los plugins en WordPress son distribuidos bajo la licencia GPL, que es la misma licencia que usa WordPress. Sin embargo, hay otras opciones disponibles. Lo mejor es indicar siempre qué licencia usa tu plugin.
Una práctica común que se fomenta es poner un bloque de comentario de la licencia cerca de la parte superior del archivo principal de tu plugin (el mismo que tiene los comentarios de cabecera del plugin).

El bloque de comentario de la licencia normalmente luce así:
```
<?php
/**
 * {Plugin Name} is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * {Plugin Name} is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with {Plugin Name}. If not, see {URI to Plugin License}.
 */
```

Cuando se combina con los comentarios de cabecera del plugin:

```
<?php
/**
 * Plugin Name: WordPress.org Plugin
 * Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
 * Description: Basic WordPress Plugin Header Comment
 * Version:     20160911
 * Author:      WordPress.org
 * Author URI:  https://developer.wordpress.org/
 * Text Domain: wporg
 * Domain Path: /languages
 * License:     GPL2
 *
 * {Plugin Name} is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * {Plugin Name} is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with {Plugin Name}. If not, see {License URI}.
 */
```

## Acciones y filtros en WordPress

Los hooks (o ganchos) de WordPress son la forma en la que una pieza de código puede interactuar con otra pieza. Es la base de cómo interactúan los plugins y temas con WordPress, pero también lo extienden.

Hay dos tipos des hooks: Actions y Filters (acciones y filtros). Para usarlos, necesitas escribir una función personalizada, también llamada de retorno (o Callback), y entonces, registrarla con un hook de WordPress para una acción o filtro específico.

+ Actions: te permiten añadir data o cambiar cómo opera WordPress. Las funciones de retorno para las acciones correrán en un punto específico de la ejecución de WordPress y pueden ejecutar alguna tarea, como mostrar una salida al usuario o insertar algo en la base de datos.
+ Filters: te dan la habilidad de cambiar datos durante la ejecución de WordPress. La función de retorno para los filtros aceptará una variable, la modificará y la devolverá. Están diseñados para trabajar de manera aislada y nunca deben tener efectos secundarios como el de afectar a variables globales.

WordPress provee muchos hooks que puedes usar, pero también puedes crear los tuyos propios, de esta forma, otros desarrolladores pueden extender y modificar tu plugin o tema.

Por otro lado, la activación y desactivación de hooks provee formas de ejecutar acciones cuando el plugin es activado o desactivado.

En la activación, los plugins pueden ejecutar una rutina para añadir reglas de reescritura o establecer valores por defecto.

En la desactivación, los plugins pueden ejecutar una rutina para eliminar datos temporales como la caché y archivos y directorios temporales.

Para configurar un hook de activación, usa la función `register_activation_hook()`:
`register_activation_hook( __FILE__, 'pluginprefix_function_to_run' );`

Para configurar un hook de desactivación, usa la función `register_deactivation_hook()`:
`register_deactivation_hook( __FILE__, 'pluginprefix_function_to_run');`

El primer parámetro en cada una de estas funciones hace referencia al archivo principal de tu plugin. Normalmente estas dos funciones se activarán dentro del archivo principal del plugin; sin embargo, si las funciones están colocadas en otro archivo, tienes que actualizar el primer parámetro para apuntar correctamente al archivo principal del plugin.

## Ejemplo de Acciones y Filtros

Puedes ver una lista detalladas de acciones y filtros en este [enlace][75a12827]. Veamos algunos ejemplos que posiblemente ya conozcas del [Curso de Creación de Temas para WordPress][5f6e74bb] o de tu experiencia propia.

Alguno de los hooks más comunes en cuanto a acciones se refiere son:

+ `wp_enqueue_scripts`
+ `admin_head`
+ `widgets_init`
+ `customize_register`

`wp_enqueue_scripts`

Este es uno de los hooks más utilizados en WordPress, y se usa para añadir un script o estilos de CSS a nuestro plugin o tema. Veamos un código de ejemplo:

```
/**
 * Ejemplo del gancho de acción wp_enqueue_script()
 *
 * Insertaremos CSS y JS en el front-end de nuestro plugin.
 * Este gancho inserta el código dentro de la función wp_head().
 * Se usa normalmente al construir temas personalizados.
 *
 */

function pluginprefix_front_end_css() {
  wp_enqueue_style( 'pluginprefix_front_end_css', plugins_url( 'css/front-end.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'pluginprefix_front_end_css' );
```

`admin_head`

Este gancho te permite hacer algo muy similar a mostrar CSS en el front-end del sitio, pero en este caso, `admin_head` lo hace en el back-end.

```
/*
 * Ejemplo del gancho de acción admin_head()
 *
 * Usaremos esto para darle estilos personalizados a nuestro plugin
 * en el área de administración de WordPress
 *
 */

function pluginprefix_back_end_css() {
  wp_enqueue_style( 'pluginprefix_back_end_css', plugins_url( 'css/back-end.css', __FILE__ ) );
}
add_action( 'admin_head', 'pluginprefix_front_end_css' );
```

`widgets_init`

Veremos cómo crear widgets más adelante en el curso, pero por ahora puedes conocer qué gancho tendrás que usar para crear tus propios widgets.

```
/*
 * Ejemplo del gancho de acción widgets_init()
 *
 * En el momento en el que se inician los widgets,
 * le decimos a WordPress que cree un nuevo widget
 * llamado My_Widget
 *
 */

function pluginprefix_widget() {
  register_widget( 'My_Widget' );
}
add_action( 'widgets_init', 'pluginprefix_widget' );```

`customize_register`

Este gancho te permitirá añadir funcionalidades al Personalizador de WordPress para un tema en concreto.

```/*
 * Ejemplo del gancho de acción customize_register()
 *
 * Añadimos una opción para personalizar nuestro tema
 * desde la pantalla del Personalizador de WordPress.
 * Este gancho nos da acceso a cuatro métodos del Personalizador.
 */

function pluginprefix_customizations( $wp_customize ) {
  /*
   * Métodos accesibles por el objeto $wp_customize
   *  - add_setting()
   *  - add_section()
   *  - add_control()
   *  - get_setting()
   *
   */
}
add_action( 'customize_register', 'pluginprefix_customizations' );
```

Veamos ahora algunos ejemplos de filtros.

`excerpt_more`

Este filtro determina cómo se corta el cuerpo del contenido si hay más contenido que el que el extracto está mostrando. Dicho de otra forma, modifica el comportamiento del botón "Leer más".

```
/*
 * Ejemplo del filtro excerpt_more()
 *
 * Modificamos el texto por defecto [...] que se muestra
 * al final del contenido cortado cuando usamos
 * the_excerpt() en nuestra plantilla
 */

function pluginprefix_custom_excerpt_more( $more ) {
  return '<a class="read-more" href="' . get_permalink( get_theID() ) . '">Read more &raquo;</a>';
}
add_filter( 'excerpt_more', 'pluginprefix_custom_excerpt_more' );
```

`the_content`

Hace exactamente lo que estás pensando. Nos da la habilidad de modificar el contenido por defecto que se muestra en la pantalla.

```
/*
 * Ejemplo del filtro the_content()
 *
 * Modificamos el contenido principal de una entrada o una página.
 * Introducimos el contenido principal como parámetro
 * y entonces retornamos el contenido modificado para mostrarlo
 * en la página.
 *
 */

function pluginprefix_make_content_social( $content ) {
  /*
   * Nos aseguramos que el código se ejecute solo en la plantilla
   * de entradas y págians únicas y dentro del loop.
   */

  if( is_singular() && is_main_query() ) {

    $social_content = "Inserta el código para compartir en redes sociales aquí.";
    $content .= $social_content;
  }

  return $content;
}
add_filter( 'the_content', 'pluginprefix_make_content_social' );
```

`comments_template`

Este filtro puede usarse también de forma similar que el anterior para mostrar mensajes sociales dentro de la sección de comentarios.

```
/*
 * Ejemplo del filtro comments_template()
 *
 * Sobreescribimos la plantilla por defecto de los comentarios
 * que se encuentra en wp-includes/comment-template.php y
 * usamos nuestro propio archivo en su lugar.
 */

function pluginprefix_custom_comment_template( $comment_template ) {

  return dirname(__FILE__) . '/inc/custom-comment-template.php';

}
add_filter( 'comments_template', 'pluginprefix_custom_comment_template' );
```

Nota que también hay una función `remove` por cada función `add`, así puedes encontrar la función `remove_action` y `remove_filter` que existen para cuando queremos eliminar un gancho nativo o de algún plugin.

En la sección anterior también hablamos sobre las funciones de Activación y Desactivación. Uno de los usos más comunes para ganchos de activación es el de refrescar los enlaces permanentes de WordPress cuando un plugin registra un nuevo Tipo de Publicación Personalizada (Custom Post Type).

```
function pluginprefix_setup_post_types()
{
    // Registra el tipo de publicación personalizada "libro"
    register_post_type( 'libro', ['public' => 'true'] );
}
add_action( 'init', 'pluginprefix_setup_post_type' );

function pluginprefix_install()
{
    // lanza la función que registra el tipo de publicación "libro"
    pluginprefix_setup_post_types();

    // limpia los enlaces permanentes después que la publicación haya sido registrada
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pluginprefix_install' );
```

Visto el código anterior, así sería cómo se desharía el proceso:

```
function pluginprefix_deactivation()
{
    // our post type will be automatically removed, so no need to unregister it

    // clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );
```

Puedes encontrar más información en las referencias de las funciones [register_activation_hook()][e522ed3e] y [register_deactivation_hook()][2963d102].

  [75a12827]: https://developer.wordpress.org/reference/hooks/ "Hooks de WordPress"
  [5f6e74bb]: https://openwebinars.net/cursos/crear-temas-para-wordpress/ "Curso de Creación de Temas para WordPress"
  [e522ed3e]: https://developer.wordpress.org/reference/functions/register_activation_hook/ "Referencia de la función register_activation_hook()"
  [2963d102]: https://developer.wordpress.org/reference/functions/register_deactivation_hook/ "Referencia de la función register_deactivation_hook()"

## Mejores prácticas

Como en casi toda plataforma de software, en WordPress también existe un código de buenas prácticas que puedes tener en cuenta a la hora de desarrollar plugins o temas. Aquí están algunas de ellas:

### Evitar colisiones de nombres

Una colisión de nombres ocurre cuando tu plugin está usando el mismo nombre para una variable, función o Clase que otro plugin. Afortunadamente puedes evitar estas colisiones usando los siguientes métodos:

#### Procedural

Por defecto, todas las variables, funcioens y Clases están definidas en el espacio de nombres global, lo que significa que es posible que tu plugin sobreescriba otras establecidas por otro plugin o viceversa.

##### Prefijo en todos sitios

Todas las variables, funciones y Classes deben estar prefijadas con un identificador único. Los prefijos previenen a otros plugins de sobreescribir tus variables y accidentalmente llamar a tus funciones y clases. También te preveerá de hacer lo mismo.

##### Comprueba implementaciones existentes

PHP provee una serie de funciones para verificar la existencia de variables, funciones, Clases y constantes. Todas estas devuelven `true` si la entidad existe:

+ isset() - variables, incluyendo arrays, objetos, etc.
+ function_exists() - funciones.
+ class_exists - Clases.
+ defined() - constantes.

##### Ejemplos:

```
<?php
if ( !function_exists( 'wporg_init' ) ) {
    function wporg_init() {
        register_setting( 'wporg_settings', 'wporg_option_foo' );
    }
}

if ( !function_exists( 'wporg_get_foo' ) ) {
    function wporg_get_foo() {
        return get_option( 'wporg_option_foo' );
    }
}
```

#### Programación Orientada a Objetos

Una forma fácil de abordar el problema de la colisión de nombres es usar una clase para el código del plugin.
Todavía necesitarás tener cuidado del nombre de la clase que quieras usar pero del resto se encargará PHP.

En el siguiente ejemplo usamos una clase abstraída con métodos estáticos para decrecentar el uso de memoria y permitir llamadas directas a métodos estáticos por conveniencia.

```
<?php
if ( !class_exists( 'WPOrg_Plugin' ) ) {
    abstract class WPOrg_Plugin
    {
        public static function init() {
            register_setting( 'wporg_settings', 'wporg_option_foo' );
        }

        public static function get_foo() {
            return get_option( 'wporg_option_foo' );
        }
    }

    WPOrg_Plugin::init();
    WPOrg_Plugin::get_foo();
}
```

#### Organización de archivos

El directorio raíz de tu plugin debe contener un archivo llamado como tu plugin: plugin-name.php y opcionalmente un archivo para la desinstalación, uninstall.php. Todos los otros archivos deben estar organizados en sub-carpetas cuando sea posible.

##### Estructura de carpetas

Una estructura de carpetas limpia ayuda a mantener los archivos similares juntos. Aquí tienes un ejemplo de estructura de carpetas como referencia:

```
/plugin-name
     plugin-name.php
     uninstall.php
     /languages
     /includes
     /admin
     /admin/js
     /admin/css
     /admin/images
     /public
     /public/js
     /public/css
     /public/images
```

### Arquitectura del plugin

La arquitectura, u organización del código, que elijas dependerá proporcionalmente del tamaño del plugin.

Para plugins pequeños de un único propósito que tienen interacciones limitadas con el core de WordPress, temas u otros plugins, hay pocos beneficios al usar la compleja ingeniería de Clases; a menos que sepas que el plugin va a expandirse posteriormente.

Para plugins grandes, con muchas líneas de código, comienza con Clases en mente. Separa estilos y archivos de script, e incluso los archivos estructurales. Esto te ayudará a organizar el código y al mantenimiento a largo plazo del mismo.

#### Carga condicional

Es útil separar el código de administración del código público. Usa el condicional `is_admin()` para ello.

```
<?php
if ( is_admin() ) {
    // we are in admin mode
    require_once( dirname( __FILE__ ) . '/admin/plugin-name-admin.php' );
}
```

#### Patrones de arquitectura

Aunque hay una gran cantidad de posibles patrones de arquitectura, se pueden agrupar fácilemente en tres variaciones:

+ Archivo único de plugin, conteniendo funciones.
+ Archivo único de plugin, conteniendo clases, objetos instanciados y funciones opcionalmente.
+ Archivo principal de plugin, y uno o más archivos de clases.

#### Patrones de arquitecturas explicados

Se han realizado implementaciones específicas de los patrones más complejos y aquí tienes algunos tutoriales (en inglés) sobre ello:

+ [Slash - Singletons, Loaders, Actions, Screens, Handlers][d02c8d15]
+ [An MVC Inspired Approach to WordPress Plugin Development][1de5aeb5]
+ [Implementing the MVC Pattern in WordPress Plugins][02eca2b5]

  [d02c8d15]: http://jaco.by/2012/12/12/slash-architecture-my-approach-to-building-wordpress-plugins/ "Slash - Singletons, Loaders, Actions, Screens, Handlers"
  [1de5aeb5]: http://www.renegadetechconsulting.com/tutorials/an-mvc-inspired-approach-to-wordpress-plugin-development "An MVC Inspired Approach to WordPress Plugin Development"
  [02eca2b5]: http://iandunn.name/wp-mvc "Implementing the MVC Pattern in WordPress Plugins"

#### Puntos de partida

En vez de empezar un plugin desde cero cada vez que quieras escribir uno, podrías querer empezar con una plantilla. La ventaja de usarlas es la consistencia entre tus propios plugins, y para plantillas comunmente usadas, un formato que otros contribuidores del plugin reconocerán fácilmente.

Esto también sirve como diferentes ejemplos de arquitecturas comparables.

+ [WordPress Plugin Boilerplate][1a110540]: Una base para el desarrollo de plugins de WordPress con el objetivo de proveer una guía clara y consistente para construir tus plugins.
+ [WordPress Plugin Bootstrap][9b9ac8bd]: esquema básico para desarrollar plugins de WordPress usando Grunt, Compass, Git y SVN.
+ [WP Skeleton Plugin][86a3cee8]: Plugin de skeleton que se centra en los tests unitarios y el uso de composer para el desarrollo.
+ [Búsqueda general de boilerplates para plugins de WordPress en GitHub][e3144952].

Por supuesto, puedes tomar diferentes aspectos de cada uno de estos y crear tu propia plantilla.

  [1a110540]: https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate "WordPress Plugin Boilerplate"
  [9b9ac8bd]: https://github.com/claudiosmweb/wordpress-plugin-boilerplate "WordPress Plugin Bootstrap"
  [86a3cee8]: https://github.com/ptahdunbar/wp-skeleton-plugin "WP Skeleton Plugin"
  [e3144952]: https://github.com/search?q=wordpress+plugin+boilerplate&ref=reposearch "Búsqueda general de boilerplates para plugins de WordPress en GitHub"

Seguridad en un plugin
======

Tienes que tener en cuenta que tu código puede ser ejecutado en cientos o quizá millones de sitios, así que la seguridad es una de las cosas más importantes.

## Comprobando las capacidades de usuario

Si tu plugin permite a los usuario enviar data; entrar en el sitio de Administración o Publico; entonces debes comprobar las capacidades del usuario.

### Roles de usuarios y capacidades

El paso más importante en crear una capa de seguridad es tener un sistema de permisos de usuarios. WordPress provee esto en forma de Roles y Capacidades de Ususario.

Todo usuario logueado en WordPress tiene unas capacidades asignadas dependiendo de su Rol.

**Los roles de usuario** son una manera elegante de decirle al usuario a qué grupo pertenece. Cada grupo tiene establecidas unas capacidades pre-definidas. Por ejemplo, el usuario principal de tu sitio tendrá el rol de Administrador mientras que otros usuarios pueden tener roles como Editor o Autor. También puedes asignar más de un usuario a un rol, puede haber dos o más Administradores para un sitio.

**Las capacidades de usuarios** son permisos específicos que se asignan a cada usuario o a un Rol de Usuario. Por ejemplo, los administradores tienen la capacidad "manage_options" que les permite ver, editar y guardar opciones para el sitio. Los editores por otro lado no tienen acceso a esta capacidad lo que les previene de interactuar con las opciones del sitio.

Estas capacidades se comprueban en varios puntos dentro del Admin. Dependiendo de las capcidades asignadas a un rol; menús, funcionalidades y otros aspectos de la experiencia en WordPress se pueden añadir o eliminar.

**Como estás construyendo plugins para WordPress, asegúrate de correr tu código solo cuando el usuario actual tiene las capacidades necesarias"**

#### Herencia

Cuanto más alto sea el rol de usuario, más capacidades tiene el mismo. Cada rol hereda del rol anterior en la jerarquía. Por ejemplo, el "Administrador", que es el rol más alto en un sitio de instalación única, hereda las capacidades de los roles: "Suscriptor", "Colaborador", "Autor" y "Editor".

#### Ejemplos

##### Sin restricciones

Este ejemplo crea un enlace en el frontend que da la capcidad de eliminar entradas:

```
<?php
/**
 * generate a Delete link based on the homepage url
 */
function wporg_generate_delete_link($content)
{
    // run only for single post page
    if (is_single() && in_the_loop() && is_main_query()) {
        // add query arguments: action, post
        $url = add_query_arg(
            [
                'action' => 'wporg_frontend_delete',
                'post'   => get_the_ID(),
            ],
            home_url()
        );
        return $content . ' <a href="' . esc_url($url) . '">' . esc_html__('Delete Post', 'wporg') . '</a>';
    }
    return null;
}

/**
 * request handler
 */
function wporg_delete_post()
{
    if (isset($_GET['action']) && $_GET['action'] === 'wporg_frontend_delete') {

        // verify we have a post id
        $post_id = (isset($_GET['post'])) ? ($_GET['post']) : (null);

        // verify there is a post with such a number
        $post = get_post((int)$post_id);
        if (empty($post)) {
            return;
        }

        // delete the post
        wp_trash_post($post_id);

        // redirect to admin page
        $redirect = admin_url('edit.php');
        wp_safe_redirect($redirect);

        // we are done
        die;
    }
}

/**
 * add the delete link to the end of the post content
 */
add_filter('the_content', 'wporg_generate_delete_link');

/**
 * register our request handler with the init hook
 */
add_action('init', 'wporg_delete_post');
```

##### Restringido a una capacidad específica

El ejemplo de arriba permite a cualquier vistante del sitio clicar en el enlace "Delete" y enviar a la papelera la entrada. Sin embargo, solo queremos que los Editores o superiores sean capaces de clicar en el enlace "Delete".

Para cumplir con este, comprobaremos que el usuario actual tenga la capacidad `edit_other_posts`, que solo tienen Editores o roles superiores:

```
<?php
/**
 * generate a Delete link based on the homepage url
 */
function wporg_generate_delete_link($content)
{
    // run only for single post page
    if (is_single() && in_the_loop() && is_main_query()) {
        // add query arguments: action, post
        $url = add_query_arg(
            [
                'action' => 'wporg_frontend_delete',
                'post'   => get_the_ID(),
            ],
            home_url()
        );
        return $content . ' <a href="' . esc_url($url) . '">' . esc_html__('Delete Post', 'wporg') . '</a>';
    }
    return null;
}

/**
 * request handler
 */
function wporg_delete_post()
{
    if (isset($_GET['action']) && $_GET['action'] === 'wporg_frontend_delete') {

        // verify we have a post id
        $post_id = (isset($_GET['post'])) ? ($_GET['post']) : (null);

        // verify there is a post with such a number
        $post = get_post((int)$post_id);
        if (empty($post)) {
            return;
        }

        // delete the post
        wp_trash_post($post_id);

        // redirect to admin page
        $redirect = admin_url('edit.php');
        wp_safe_redirect($redirect);

        // we are done
        die;
    }
}

if (current_user_can('edit_others_posts')) {
    /**
     * add the delete link to the end of the post content
     */
    add_filter('the_content', 'wporg_generate_delete_link');

    /**
     * register our request handler with the init hook
     */
    add_action('init', 'wporg_delete_post');
}
```

## Validación de datos

La validación de datos es el proceso de analizar los datos contra un patro predefinido con un resultado definido (válido o no valido).

Normalmente esto se aplica a los datos que vienen desde fuentes externas como entrada de usuarios y llamadas a webservices via APIs.

Ejemplos sencillos de validación de datos son:

+ Comprueba que los campos requeridos no se hayan dejado en blanco.
+ Comprueba que el número de teléfono introducido solo contiene números y puntuación.
+ Comprueba que el código postal introducido es un código postal válido.
+ Comprueba que la cantidad de un campo es mayor que 0.

**La validación de datos se debe desarrollar tan pronto como sea posible.** Esto significa validar los datos antes de realizar cualquier acción.

> La validación de datos se puede desarrollar usando JavaScript en el front end y PHP en el back end.

### Validando los datos

Hay al menos tres formas de hacerlo: funciones de PHP, funciones de WordPress y funciones personalizadas que tu escribas.

#### Funciones de PHP

La validación básica es factible usando muchas de las funciones de PHP, incluyendo estas:

+ `isset()` y `empty()` para comprobar si una variable existe y no está en blanco.
+ `mb_strlen()` o `strlen()` para comprobar que una cadena tenga el número de caracteres esperados.
+ `preg_match()`, `strpos()` para comprobar ocurrencias de ciertas cadenas en otras cadenas.
+ `count()` para comprobar cuántos ítems hay en un array.
+ `in_array()` para comprobar si algo existe dentro de un array.

#### Funciones de WordPress

WordPress provee muchas funciones útiles que te ayudan a validar diferentes tipos de datos. Aquí hay algunos ejemplos:

+ `is_email()` va a validar si es una dirección de correo electrónico válida.
+ `term_exists()` comprueba si un tag, categoría u otra taxonomía existe.
+ `username_exists()` comprueba si nombre de usuario existe.
+ `validate_file()` validará que una ruta insertada hacia un archivo sea una ruta real (pero no si el archivo existe).

Puedes comprobar la [referencia del código de WordPress][9ff72cbb] para más funciones como estas. Busca funciones con nombres como estos: `*_exists()`, `*_validate()` y `is_*()`. No todas estas son funciones de validación pero muchas son útiles.

#### Funciones de PHP y JavaScript personalizadas

Puedes escribir tus propias funciones e incluirlas en tu plugin. Cuando escribas funciones de validación debes nombrarlas como una pregunta (ejemplos: `is_phone`, `is_available`, `is_es_zipcode`).

La función debe devolver un valor booleano, sea `true` o `false`, dependiendo de si el dato es válido o no. Esto te permetirá usar la función como condición.

  [9ff72cbb]: https://developer.wordpress.org/reference/ "Referencia del código de WordPress"

#### Ejemplo

Digamos que vas a realizar una consulta a la base de datos sobre una publicación y quieres darle al usuario la posibilidad de ordenar los resulatdos de la consulta.

Este ejemplo de código comprueba una clave de ordenación entrante (llamada orderby) contra un array de claves permitidas usando la función de PHP `in_array` con tipado estricto habilidado (que dice a PHP que se asegure que la clave de ordenación no está solo en el array sino también en la cadena como se espera).

```
<?php
$allowed_keys = ['author', 'post_author', 'date', 'post_date'];

$orderby = sanitize_key($_POST['orderby']);

if (in_array($orderby, $allowed_keys, true)) {
    // modifica la consulta para ordenar por la clave orderby
}
```

## Securizando la entrada

Securizar la entrada es el proceso de sanear (limpiar y filtrar) datos de entrada. El saneamiento se usa cuando no sabes qué esperar o no quieres ser estricto en la validación de datos.

**En cualquier lugar de tu plugin que aceptes datos potencialmente inseguros, es importante de validarlos y sanearlos**

### Saneando los datos

La forma más fácil de sanear los datos es con las funciones de WordPress. La serie de funciones de ayuda `sanitize_*()` soy muy buenas, ya que te aseguran que estás usando datos finales seguros, y requieren un mínimo esfuerzo por tu parte:

+ `sanitize_email()`
+ `sanitize_file_name()`
+ `sanitize_html_class()`
+ `sanitize_key()`
+ `sanitize_meta()`
+ `sanitize_mime_type()`
+ `sanitize_option()`
+ `sanitize_sql_orderby()`
+ `sanitize_text_field()`
+ `sanitize_title()`
+ `sanitize_title_for_query()`
+ `sanitize_title_with_dashes()`
+ `sanitize_user()`
+ `esc_url_raw()`
+ `wp_filter_post_kses()`
+ `wp_filter_nohtml_kses()`

### Ejemplo

Digamos que tenemos un campo de entrada llamado título (title).

`<input id="title" type="text" name="title">`

Puedes sanear los datos de entrada con la función `sanitize_text_field()`:

```
$title = sanitize_text_field($_POST['title']);
update_post_meta($post->ID, 'title', $title);
```

Bajo la cortina, `sanitize_text_field()` hace lo siguiente:

+ Comprueba por codificación UTF-8 no válida.
+ Convierte el símbolo menor-que (<) a entidad.
+ Elimina todas las etiquetas.
+ Elimina los saltos de línea, tabulaciones y espacios en blanco extra.
+ Elimina los bytes nulos.

## Securizando la salida

Securizar la salida es el proceso de escapado de datos de salida. Escapado significa eliminar los datos no queridos, como HTML mal formado o etiquetas de scripts.

**Cuando estás procesando datos, asegúrate de escaparlos correctamente. El escapado previene de ataques XSS.**

### Escapado

El escapado te ayuda a securizar tus datos antes de procesarlos para el usuario final. WordPress tiene unas cuantas de funciones que puedes usar para los escenarios más comunes.

+ `esc_html()` - Usa esta función en cualquier momento que un elemento HTML encierre una sección de datos que se vayan a mostrar.
+ `esc_url()` - Usa esta función en todas las URLs, incluyendo aquellas en los atributos `src` y `href` de un elemento HTML.
+ `esc_js()` - Usa esta función para el código JavaScript en el mismo documento.
+ `esc_attr()` - Usa esta función en todo lo que esté mostrado en un atributo de un elemento HTML.

> La mayoría de las funciones de WordPress prepararán tus datos para mostrarlos escapados, así que no necesitarás escapar los datos de neuvo. Por ejemplo, puedes usar con seguridad la función `the_title()` sin escapado.

### Escapado con Localización

En vez de usar `echo` para mostrar datos, es normal usar las funciones de localización de WordPress, como `_e()` o `__()`. Estas funciones simplemente envuelven una función de localización dentro de una función de escapado:

```
esc_html_e('Hello World', 'text_domain');
// Es lo mismo que
echo esc_html(__('Hello World', 'text_domain'));
```

Estas funciones de ayuda combinan localización y escapado:

+ `esc_html__()`
+ `esc_html_e()`
+ `esc_html_x()`
+ `esc_attr__()`
+ `esc_attr_e()`
+ `esc_attr_x()`

### Escapado personalizado

En el caso que necesites escapar tu salida de una forma específica, la función `wp_kses()` (pronunciada "kisses") será util. Esta función te asegura que sólo los elementos HTML especificados, los atributos y los valores de atributos aparezcan en tu salida y normalicen las entidades HTML.

```
$allowed_html = [
    'a'      => [
        'href'  => [],
        'title' => [],
    ],
    'br'     => [],
    'em'     => [],
    'strong' => [],
];
echo wp_kses($custom_content, $allowed_html);
```

La función `wp_kses_post()` es una función envolvente para `wp_kses` donde `$allowed_html` es una configuración de reglas usadas por el contenido de una publicación.

`echo wp_kses_post( $post_content )`

## Nonces

Los Nonces son números generados para verificar el origen y destino de la solicitud por razones de seguridad. Cadad nonce puede ser usado una sola vez. La palabra Nonce se forma del inglés once (una sola vez) y N (Número).

Si tu plugin permite a los usuarios enviar datos; sea en el lado de Administración o público; tienes que asegurarte que el usuario es quien dice ser y que tiene las capacidades necesarias para realizar esa acción. Haciendo ambas cosas los datos cambiaran solo cuando el usuario espere que cambien.

### Usando Nonces

Siguiendo el ejemplo que usamos en la sección de capacidades de usuario, el siguiente paso para el envío de datos de un usuario es usar nonces.

La capacidad se asegurará que solo los usuarios con permisos para eliminar publicaciones sean capaces de eliminar una publicación. Pero ¿qué hay si alguien quiere engañarte y pulsa ese enlace? Tu tienes las capacidades necesarias, así que podrías eliminar una publicación inconscientemente.

Los nonces pueden ser usados para comprobar que el usuario actual está intenando realizar la acción en ese momento.

Cuando tu generas un enlace de borrado, tienes que usar la función `wp_create_nonce()` para añadir un nonce al link, el argumento pasado a la función se asegurará de que el nonce creado sea único para una acción en particular.

Entonces, cuando estás procesando una petición del enlace de borrado, puedes comprobar que el nonce es el que tu esperabas que fuera.

### Ejemplo completo

```
<?php
/**
 * generate a Delete link based on the homepage url
 */
function wporg_generate_delete_link($content)
{
    // run only for single post page
    if (is_single() && in_the_loop() && is_main_query()) {
        // add query arguments: action, post, nonce
        $url = add_query_arg(
            [
                'action' => 'wporg_frontend_delete',
                'post'   => get_the_ID(),
                'nonce'  => wp_create_nonce('wporg_frontend_delete'),
            ],
            home_url()
        );
        return $content . ' <a href="' . esc_url($url) . '">' . esc_html__('Delete Post', 'wporg') . '</a>';
    }
    return null;
}

/**
 * request handler
 */
function wporg_delete_post()
{
    if (
        isset($_GET['action']) &&
        isset($_GET['nonce']) &&
        $_GET['action'] === 'wporg_frontend_delete' &&
        wp_verify_nonce($_GET['nonce'], 'wporg_frontend_delete')
    ) {

        // verify we have a post id
        $post_id = (isset($_GET['post'])) ? ($_GET['post']) : (null);

        // verify there is a post with such a number
        $post = get_post((int)$post_id);
        if (empty($post)) {
            return;
        }

        // delete the post
        wp_trash_post($post_id);

        // redirect to admin page
        $redirect = admin_url('edit.php');
        wp_safe_redirect($redirect);

        // we are done
        die;
    }
}

if (current_user_can('edit_others_posts')) {
    /**
     * add the delete link to the end of the post content
     */
    add_filter('the_content', 'wporg_generate_delete_link');

    /**
     * register our request handler with the init hook
     */
    add_action('init', 'wporg_delete_post');
}
```

Página de configuración del plugin
======

## Crear una página de configuración

El primer paso para empezar a darle funcionalidad a nuestro plugin es tener un sitio donde poder modificar el comportamiento del mismo. Esto normalmente lo haremos en el Escritorio de WordPress. Podemos crear una sección única para nuestro plugin, o añadirlo a secciones que ya tiene WordPress, como Ajustes, Herramientas u otras.

Como vimos en secciones anteriores, WordPress trabaja con ganchos (acciones y filtros) para la creación de plugins. Por lo tanto, para insertar nuestra página de configuración del plugin usaremos el gancho `admin_menu`. Concretamente, si queremos insertarlo en el menú Ajustes, contamos con la función `add_options_page()`. El código para crear nuestra página de configuración básica en WordPress sería:

```
/*
 * Add a link to our plugin in the admin menu
 * under 'Settings > OpenWebinars Badges'
 */

function openwebinars_badges_menu() {

  /*
   * Use the add_options page function
   * add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function );
   */

  add_options_page(
    'Official OpenWebinars Badges Plugins',
    'OpenWebinars Badges',
    'manage_options',
    'openwebinars-badges',
    'openwebinars_badges_options_page'
  );
}
add_action( 'admin_menu', 'openwebinars_badges_menu' );
```

Esto creará una página de configuración vacía en Ajustes -> OpenWebinars Badges. Pero en la función `add_options_page()` hemos indicado que la función que "llenará" nuestra página, o la función a ejecutar dentro de esa página sea `openwebinars_badges_options_page`. Así que creemos esa función y démosle contenido a nuestra página de configuración del plugin.

```
function openwebinars_badges_options_page() {
  if( !current_user_can( 'manage_options' ) ) {
    wp_die( 'You do not have sufficient permissions to access this page.' );
  }

  echo '<p>Welcome to our plugin page!</p>';
}
```

Es importante que securicemos nuestro plugin desde el principio. Esta página solo estará disponible para los usuarios que puedan manejar opciones, es decir de Editores hacia arriba.

Échale un vistazo a otras opciones de añadir tu página de configuración del plugin al escritorio de WordPress aquí: [Menús de administración][381341aa].

  [381341aa]: https://codex.wordpress.org/Administration_Menus "Menús de administración"

## Añadir estilos a la página de configuración

Quizás te preguntes ¿cómo puedo hacer para que mi plugin luzca como el resto del Escritorio de WordPress? WordPress tiene una serie de clases de CSS y estilos predefinidos, puedes echarle un vistazo instalando este plugin: [WordPress Admin Style][992707e6].

Además, puedes crear tus propios estilos añadiendo un fichero CSS y tus propias clases a los elementos CSS, recuerda que para enlazar un fichero de estilos a tu plugin, tienes que usar la función `wp_enqueue_style`:

```
function openwebinars_badges_styles() {
  wp_enqueue_style( 'openwebinars_badges_styles', plugins_url( 'openwebinars-badges/openwebinars-badges.css' ) );
}
add_action( 'admin_head', 'openwebinars_badges_styles' );
```

[992707e6]: https://github.com/bueltge/WordPress-Admin-Style "Plugin de WordPress Admin Style"

## Trabajando con formularios en la página de configuración

Como bien sabes, para trabajar con formularios en PHP tenemos dos métodos de envío y recepción de datos: GET y POST. Ya hemos usado un ejemplo del método GET en nuestro plugin, puedes verlo de hecho en la URL del mismo: `options-general.php?page=openwebinars-badges`.

Es importante validar y securizar tus formularios. Una buena forma de hacerlo es añadir un campo oculto que nos prevendrá de SPAM en nuestros formularios.

```<input type="hidden" name="openwebinars_form_submitted" value="Y">```

En el lado servidor debemos comprobar este campo para comenzar a renderizar el formulario:

```/*
 * Check that our form has been submitted
 */
if ( isset( $_POST['openwebinars_form_submitted'] ) ) {
	$hidden_field = esc_html( $_POST['openwebinars_form_submitted'] );

	if ( $hidden_field == 'Y' ) {
		$openwebinars_email = esc_html( $_POST['openwebinars_email'] );

		// echo $openwebinars_email;
	}
}
```

## Funciones básicas con la tabla wp_options

Una vez que sabemos cómo obtener los datos, tenemos que aprender a poder guardarlos en la Base de Datos para poder acceder a ellos nuevamente. WordPress nos proporciona una tabal llamada `options` para este propósito.

La tabla `options` tiene 4 campos:

+ `option_id` - se autoincrementa.
+ `option_name` - toma un nombre único, así podremos encontrar este campo fácilmente.
+ `option_value` - guardará toda la información del plugin que queramos.
+ `autoload` - por defecto es `yes`, así podremos cargar la información desde el arranque de WordPress.

## API de ajustes

WordPress provee dos APIs para hacer las interfaces administrativas más fáciles de construir, securizar y que sean acordes con el diseño del resto.

La API de Ajustes se centra en proveer un camino para los desarrolladores par acrear formularios y manejar los datos de los mismos.

Aquí tienes algunos ejemplos que realiza la API:

+ Manejo de peticiones de formularios - Deja que WordPress recupere y guarde tus peticiones `$_POST`.
+ Incluye medidas de seguridad - Obtienes medidas de seguridad extra como nonces, etc.
+ Sanea tus datos - Obtieens acceso a los mismos métodos que el resto de WordPress usa para asegurar cadenas.

En [este enlace][9cb865ef] puedes ver los métodos que usarás para utilizar esta API.

  [9cb865ef]: https://developer.wordpress.org/plugins/settings/settings-api/#function-reference "Funciones para la API de ajustes"

## API de opciones

La API de opciones se centrar en manejar los datos con un sistema sencillo de clave/valor.


Aunque MySQL no permite guardar arrays, sí que podemos serializarlos en cadenas. Las funciones `add_option`, `get_option`, `update_option` y `delete_option` nos ayudarán a realizar operaciones CRUD con la tabla `options` y nuestro plugin.

```
// Global variable
$options = array();
/*
 * Store form options in database
 */
$options['openwebinars_email']    = $openwebinars_email;
$options['last_updated']          = time();

update_option( 'openwebinars_badges', $options );
```

Conectando el plugin con APIs de terceros
======

## JSON como API

JSON son las siglas para JavaScript Object Notation, por lo tanto un archivo JSON contiene un objeto JavaScript, pero casi todos los lenguajes de programación modernos poseen métodos para convertir ese objeto de JS en algo entendible por el propio lenguaje.

Usamos JSON en nuestros sitios para intercambiar datos entre diferentes sitios o incluso dentro del mismo sitio. Para nuestro proyecto, recibiremos la información de los badges de un usuario en un archivo JSON. Usaremos la [Api de OpenBadges Backpack][4b5490bd].

  [4b5490bd]: https://github.com/mozilla/openbadges-backpack/blob/master/docs/apis/displayer_api.md "Mozilla Hosted Backpack - Displayer API"

## Obteniendo y almacenando un feed JSON

Para obtener datos de una API puedes usar dos funciones que usan los diferentes métodos, GET y POST, las funciones son `wp_remote_get` y `wp_remote_post`.

Sin embargo, estos métodos devuelven un array, y no texto en formato JSON, para poder obtenerlo, normalmente tendrás que apuntar al cuerpo del array y decodificarlo.

## Parseando JSON con PHP

Para poder pasar la respuesta de Array a JSON, PHP tiene una serie de métodos que nos pueden ahorrar mucho trabajo, ejemplo de ello es el método `json_decode`.

Aquí tienes un ejemplo básico de llamada a una API y parseo de la información en JSON.

```
function openwebinars_badges_get_badges( $openwebinars_email ) {
  $json_feed_url= 'https://backpack.openbadges.org/displayer/convert/email';
  $args = array( 'body' => array( 'email' => $openwebinars_email ) );

  $json_feed = wp_remote_post( $json_feed_url, $args );

  $openwebinars_profile = json_decode( $json_feed['body'] );

  return $openwebinars_profile;
}
```

Plugins Orientados a Objetos
======

## Repaso a la OOP

Una de las cosas que a los desarrolladores le gustan (u odian) de WordPress es su baja barrera de entrada. La media de los programadores comenzarán a escribir código eficiente en WordPress en muy poco tiempo. Pero WordPress no es solo una herramienta con la que se pueden hacer pequeñas cosas fácilmente. WordPress permite desplegar todo el poder que tienen sus lenguajes base, como PHP.

Uno de los paradigmas de programación más utilizados en la actualidad es la Programación Orientada a Objetos. Este paradigma se basa en los siguietnes componentes:

+ Clases. Una clase es un modelo para la creación de un objeto. Describiéndolo semánticamente, un sustantivo sería un objeto, un adjetivo un atributo o propiedad y un verbo sería un método o función.
+ Tipos. Existen dos tipos de datos, simples y complejos. Los tipos de datos simples represetan el dato tal como se muestra. Normalmente son datos de tipo verdadero o falso, decimales y palabras y/o sentencias. Los tipos de datos comlejos son principalmente arrays y objetos.
+ Estructuras d econtrol. Describen como podemos controlar el flujo del código a través de una serie de factores. Las princiapels son `if/then` y `switch/case`. Pero existen estructuras más complejas como los bucles, `for`, `foreach`, `do` y `while`.
+ Funciones y atributos. Las funciones son usadas como una unidad de trabajo completa pero también usan algunas de las estructuras mencionadas arribas, variables, condicionales, bucles, etc. Los atributos son variables dentro de una clase.
+ Ámbito (Scope). El scope se refiere a cómo las variables y las funciones pueden ser accesibles de objetos u objetos hijos dentro del programa. El ámbito de estas variables y funciones puede ser: `public`, `protected` y `private`.

## Construyendo un plugin Orientado a Objetos

Un plugin orientado a objetos requiere más que nunca una organización de archivos y carpetas muy eficiente. Normalmente tendremos como mínimo un archivo PHP con el plugin del plugin, archivo README, carpetas admin, includes, languages y public.

![Estructura de carpetas de un plugin](https://www.dropbox.com/s/xe8nbqo2qlv4qxk/single-post-meta-manager-organization.jpg?raw=0)

Todos los archivos que realicen tareas "administrativas" estarán en la carpeta `admin`. Un ejemplo de estructura de archivo que realice tareas administrativas sería:

```
<?php

class Single_Post_Meta_Manager_Admin {

    protected $version;

    public function __construct( $version ) {
        $this->version = $version;
    }

    public function enqueue_styles() {

    }

    public function add_meta_box() {

    }

}
```

En la carpeta Includes solemos colocar un archivo llamado `loader` que se encarga de coordinar todos los ganchos existentes en el plugin:

```
<?php

class Single_Post_Meta_Manager_Loader {

    protected $actions;

    protected $filters;

    public function __construct() {

    }

    public function add_action( $hook, $component, $callback ) {

    }

    public function add_filter( $hook, $component, $callback ) {

    }

    private function add( $hooks, $hook, $component, $callback ) {

    }

    public function run() {

    }

}
```

Finalmente, el código principal de nuestro plugin estará incluido en el archivo principal o podemos crear una nueva clase en la carpeta includes:

```
<?php

class Single_Post_Meta_Manager {

    protected $loader;

    protected $plugin_slug;

    protected $version;

    public function __construct() {

        $this->plugin_slug = 'single-post-meta-manager-slug';
        $this->version = '0.1.0';

    }

    private function load_dependencies() {

    }

    private function define_admin_hooks() {

    }

    public function run() {

    }

    public function get_version() {
        return $this->version;
    }

}
```

Si hemos elegido la primera opción, crear una clase en la carpeta includes con el código principal, entonces en nuestro arcihvo principal en la raíz de nuestro plugin tendremos que inciar nuestro código.

```
if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-single-post-meta-manager.php';

function run_single_post_meta_manager() {

    $spmm = new Single_Post_Meta_Manager();
    $spmm->run();

}

run_single_post_meta_manager();
```

## Documentando el plugin

La documentación oficial de WordPress provee una [guía específica][1b02483a] para la documentación en PHP. Lo primero queu tenemos que tener en cuenta en nuestra documentación son:

+ Comentarios en cabecera de archivos.

```
/**
 * Short Description (no period for file headers)
 *
 * Long Description.
 *
 * @link URL
 * @since x.x.x (if available)
 *
 * @package WordPress
 * @subpackage Component
 */
```

+ Comentarios en línea de sentencias `require`.

```
/**
 * Short description. (use period)
 */
require_once( ABSPATH . '/filename.php' );
```

+ Definiciones de clases y funciones.

```
/**
 * Short description. (use period)
 *
 * Long description.
 *
 * @since x.x.x
 *
 * @see Function/method/class relied on
 * @link URL
 */
```

```
/**
 * Short description. (use period)
 *
 * Long description.
 *
 * @since x.x.x
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
```

+ Variables y propiedades de clases.

```
/**
 * Short description. (use period)
 *
 * @since x.x.x
 * @access (private, protected, or public)
 * @var type $var Description.
 */
```

Hablemos también de los PSR Standars, estos son recomendaciones propuestas por el grupo PHP Framework Interop Gropu. Puedes leer sobre estos estándares aquí: [Recomendaciones de PHP Standards][e8d1946d].

  [1b02483a]: https://make.wordpress.org/core/handbook/best-practices/inline-documentation-standards/php/ "Estándar de documentación en PHP"
  [e8d1946d]: http://www.php-fig.org/psr/ "PHP Standars Recommendations"

## Herencia

En la programación orientada a objetos, la herencia es cuando un objeto o clase está basado en otro objeto o clase, usando la misma implementación. Es un mecanismo para reusar el código. Las relaciones de objetos y clases a través de la herencia dan origen a la jerarquía.

PHP provee las siguientes facilidades para usar la herencia:

+ `extends` es una palabra reservada que indica que una clase es hija de otra clase.
+ `private` es un atributo que se aplica a las propiedades y funciones que significa que son accesible sólo dentro del contexto de la clase en la que han sido definidas.
+ `protected` es similar a `private` con la excepción que las propiedades y métodos que estén marcadas como `protected` pueden ser accesible por la clase dada y por cualquier hijo.
+ `public` es lo opuesto a `privadte` lo que significa que cualquier clase - la clase dada, una subclase o una clase de terceros - puede acceder a la propiedad o método para cambiar su información o llamar a la función.

El operador `::` permite acceder a elementos estáticos o constantes y socbreescribir propieaddes o métodos de una clase.

Creando Widgets y Shortcodes
======

## Cómo crear Widgets de WordPress

Para construir un widget usaremos la función `register_widget`. Puedes usar el código de ejemplo básico que aparece en la documentación de WordPress.

```
class MyNewWidget extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'My New Widget Title' );
	}

	function widget( $args, $instance ) {
		// Widget output
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
}

function myplugin_register_widgets() {
	register_widget( 'MyNewWidget' );
}

add_action( 'widgets_init', 'myplugin_register_widgets' );
```

Los Widgets son un buen ejemplo de Programación Orientada a Objetos en WordPress. Analizaremos las principales funciones que incluye la clase Widget y para qué sirven.

El método `widget` nos permitirá establecer las opciones que se mostrarán en la página de Edición de Widgets en el Escritorio de WordPress. Para ello podemos usar la función [`extract()`][75e479b8] y crear una variable por cada atributo del array `$args`. Luego usaremos estos argumentos para mostrar el título, la descripción y otras opciones en el editor de Widgets.

El método `update` sustituye los parámetros asignados a la antigua instancia del widget y los asigna a la nueva.

El método `form` es el que nos permitirá "imprimir" o mostrar los atributos extraídos desde el método `widget` y mostrarlos en la pantalla de Edición de Widgets. Para ello podremos crear un archivo en el que incluiremos el HTML para estos elementos y añadirlo con la función `require`.

  [75e479b8]: http://php.net/manual/es/function.extract.php "Función extract"

## Añadiendo ajustes a un Widget



## Añadiendo estilos personalizados a un Widget

## Añadiendo estilos personalizados a un Widget en el Front End

## Cómo crear un Shortcode

## Añadiendo AJAX a plugins en el Front End

Extendiendo un plugin
======

## Metadatos

## Custom Post Types

## Taxonomías

## Usuarios

## JavaScript en un plugin PHP

## Cron de WordPress

## Internacionalización del plugin

Lanzamiento y soporte de un plugin de WordPress
======

## El archivo Readme.txt

## Añadiendo el plugin al repositorio de WordPress

## Dar soporte y monetizar nuestro plugin

## Herramientas para desarrolladores
