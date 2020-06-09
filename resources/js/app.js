/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
 
import swal from 'sweetalert2';
window.swal = swal;

//toast
// const toastsuccess = swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: false,
//     background: '#e1f6d0',
//     icon: 'success',
//     timer: 5000,
//     // timerProgressBar: true,
//     onOpen: (toast) => {
//       toast.addEventListener('mouseenter', swal.stopTimer)
//       toast.addEventListener('mouseleave', swal.resumeTimer)
//     }
// })

// const toasterror = swal.mixin({
//   toast: true,
//   position: 'top-end',
//   showConfirmButton: false,
//   background: '#edc3c3',
//   icon: 'error',
//   timer: 5000,
//   // timerProgressBar: true,
//   onOpen: (toast) => {
//     toast.addEventListener('mouseenter', swal.stopTimer)
//     toast.addEventListener('mouseleave', swal.resumeTimer)
//   }
// })

// const toastinfo = swal.mixin({
//   toast: true,
//   position: 'top-end',
//   showConfirmButton: false,
//   background: '#d0e0f4',
//   icon: 'info',
//   iconHtml: '<i style="font-size: 0.9rem;" class="far fa-flag"></i>',
//   timer: 5000,
//   // timerProgressBar: true,
//   onOpen: (toast) => {
//     toast.addEventListener('mouseenter', swal.stopTimer)
//     toast.addEventListener('mouseleave', swal.resumeTimer)
//   }
// })

// modales
const toastsuccess = swal.mixin({
  showConfirmButton: true,
  icon: 'success',
  timer: 5000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
})

const toasterror = swal.mixin({
showConfirmButton: true,
background: '#eddad8',
icon: 'error',
timer: 5000,
timerProgressBar: true,
onOpen: (toast) => {
  toast.addEventListener('mouseenter', swal.stopTimer)
  toast.addEventListener('mouseleave', swal.resumeTimer)
}
})

const toastinfo = swal.mixin({
showConfirmButton: true,
background: '#d0e0f4',
icon: 'info',
timer: 5000,
timerProgressBar: true,
onOpen: (toast) => {
  toast.addEventListener('mouseenter', swal.stopTimer)
  toast.addEventListener('mouseleave', swal.resumeTimer)
}
})

const toastwarning = swal.mixin({
  showConfirmButton: true,
  icon: 'warning',
  background: '#ffe28c',
  timer: 5000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
})

const modalconfirm = swal.mixin({
  showConfirmButton: true,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#007bff',
  cancelButtonColor: '#dc3545',
  // background: '#f8f3e5',
})

const toast = swal.mixin({
  showConfirmButton: true,
  timer: 5000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
})

window.toastsuccess = toastsuccess;
window.toast = toast;
window.toasterror = toasterror;
window.toastinfo = toastinfo;
window.toastwarning = toastwarning;
window.modalconfirm = modalconfirm;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('contactos', require('./components/RRHH/contactosComponent.vue').default);
Vue.component('pagination', require('./components/Pagination.vue').default);
Vue.component('datatable', require('./components/ColumUserdatabase.vue').default);
Vue.component('empleadoedit', require('./components/RRHH/empleadoeditComponent.vue').default);
Vue.component('empresacreate', require('./components/Empresa/empresacreateComponent.vue').default);
Vue.component('ubicaciones', require('./components/Empresa/ubicacionesComponent.vue').default);
//departamentos
Vue.component('departamentos', require('./components/Empresa/departamento/departamentosComponent.vue').default);
Vue.component('creardepartamento', require('./components/Empresa/departamento/creardepartamentoComponent.vue').default);
Vue.component('editardepartamento', require('./components/Empresa/departamento/editardepartamentoComponent.vue').default);
//areas
Vue.component('areas', require('./components/Empresa/area/areasComponent.vue').default);
Vue.component('creararea', require('./components/Empresa/area/crearareaComponent.vue').default);
Vue.component('editararea', require('./components/Empresa/area/editarareaComponent.vue').default);
//cargos
Vue.component('cargos', require('./components/Empresa/cargo/cargosComponent.vue').default);
Vue.component('crearcargo', require('./components/Empresa/cargo/crearcargoComponent.vue').default);
Vue.component('editarcargo', require('./components/Empresa/cargo/editarcargoComponent.vue').default);
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
//Usuario
Vue.component('perfil', require('./components/Usuario/perfilComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
