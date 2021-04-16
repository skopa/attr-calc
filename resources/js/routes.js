import ProjectsListComponent from "./components/Projects/ProjectsListComponent";
import AttributesListComponent from "./components/Attributes/AttributesListComponent";
import ProjectDetailsComponent from "./components/Projects/ProjectDetailsComponent";
import ProjectEditComponent from "./components/Projects/ProjectEditComponent";
import InstructionComponent from "./components/InstructionComponent";


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
        name: 'project-edit',
        path: '/projects/edit/:id',
        component: ProjectEditComponent
    },
    {
        name: 'attributes',
        path: '/parameters',
        component: AttributesListComponent
    },
    {
        name: 'instruction',
        path: '/instruction',
        component: InstructionComponent
    },

];
