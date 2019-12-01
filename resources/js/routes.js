import ProjectsListComponent from "./components/Projects/ProjectsListComponent";
import AttributesListComponent from "./components/Attributes/AttributesListComponent";
import ProjectDetailsComponent from "./components/Projects/ProjectDetailsComponent";
import ProjectEditComponent from "./components/Projects/ProjectEditComponent";
import AttributeEditComponent from "./components/Attributes/AttributeEditComponent";


export default [
    {
        name: 'home',
        path: '/',
        component: ProjectsListComponent
    },
    {
        name: 'project-details',
        path: '/projects/:id',
        component: ProjectDetailsComponent
    },
    {
        name: 'edit-project',
        path: '/projects/edit/:id',
        component: ProjectEditComponent
    },
    {
        name: 'attributes',
        path: '/attributes',
        component: AttributesListComponent
    },
    {
        name: 'edit-attribute',
        path: '/attributes/:id',
        component: AttributeEditComponent
    },

];
