/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
 
import swal from 'sweetalert2';
window.swal = swal;

const toastsuccess = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    background: '#e1f6d0',
    icon: 'success',
    timer: 5000,
    // timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', swal.stopTimer)
      toast.addEventListener('mouseleave', swal.resumeTimer)
    }
})

const toasterror = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  background: '#edc3c3',
  icon: 'error',
  timer: 5000,
  // timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
})

const toastinfo = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  background: '#d0e0f4',
  icon: 'info',
  iconHtml: '<i style="font-size: 0.9rem;" class="far fa-flag"></i>',
  timer: 5000,
  // timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
})

window.toastsuccess = toastsuccess;
window.toasterror = toasterror;
window.toastinfo = toastinfo;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('contactos', require('./components/RRHH/contactosComponent.vue').default);
Vue.component('pagination', require('./components/Pagination.vue').default);
Vue.component('datatable', require('./components/ColumUserdatabase.vue').default);
Vue.component('empleadoedit', require('./components/RRHH/empleadoeditComponent.vue').default);
Vue.component('empresacreate', require('./components/Empresa/empresacreateComponent.vue').default);
Vue.component('ubicaciones', require('./components/Empresa/ubicacionesComponent.vue').default);
//usuarios
Vue.component('usuarios', require('./components/Admin/Usuarios/usuariosComponent.vue').default);
Vue.component('editarusuario', require('./components/Admin/Usuarios/editarusuarioComponent.vue').default);
Vue.component('crearusuario', require('./components/Admin/Usuarios/crearusuarioComponent.vue').default);
//roles
Vue.component('roles', require('./components/Admin/Roles/rolesComponent.vue').default);
Vue.component('crearrol', require('./components/Admin/Roles/crearrolComponent.vue').default);
Vue.component('editarrol', require('./components/Admin/Roles/editarrolComponent.vue').default);
//rpermisos
Vue.component('permisos', require('./components/Admin/Permisos/permisosComponent.vue').default);
Vue.component('crearpermiso', require('./components/Admin/Permisos/crearpermisoComponent.vue').default);
Vue.component('editarpermiso', require('./components/Admin/Permisos/editarpermisoComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
