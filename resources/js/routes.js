import ProjectsListComponent from "./components/Projects/ProjectsListComponent";
import AttributesListComponent from "./components/Attributes/AttributesListComponent";
import ProjectDetailsComponent from "./components/Projects/ProjectDetailsComponent";
import EditProjectComponent from "./components/Projects/EditProjectComponent";

export default [
    {
        name: 'home',
        path: '/',
        component: ProjectsListComponent
    },
    {
        name: 'attributes',
        path: '/attributes',
        component: AttributesListComponent
    },
    {
        name: 'project-details',
        path: '/projects/:id',
        component: ProjectDetailsComponent
    },
    {
        name: 'edit-project',
        path: '/projects/edit/:id',
        component: EditProjectComponent
    }
];
