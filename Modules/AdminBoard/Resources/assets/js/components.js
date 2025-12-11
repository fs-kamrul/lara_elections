
import EducationsComponent from './components/EducationsComponent'
import FacilitiesComponent from "./components/FacilitiesComponent.vue";

if (typeof vueApp !== 'undefined') {
    vueApp.booting((vue) => {
        vue.component('educations-component', EducationsComponent)
        vue.component('facilities-component', FacilitiesComponent)
    })
}
