import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/Home'

import Courses from  '@/pages/courses/Courses'

import Students from '@/pages/students/Students'  
import StudentsStore from '@/pages/students/Store'
import StudentsUpdate from '@/pages/students/Update'
import StudentsDetails from '@/pages/students/Details'

import Enrollments from '@/pages/enrollments/Enrollments'


Vue.use(Router);

const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
        meta: {}
    },
    {
        name: 'courses',
        path: '/courses',
        component: Courses,
        meta: {}
    },
    {
        name: 'students',
        path: '/students',
        component: Students,
        meta: {}
    },
    {
        name: 'store-students',
        path: '/students/store',
        component: StudentsStore,
        meta: {}
    },
    {
        name: 'update-students',
        path: '/students/update/:student_id',
        component: StudentsUpdate,
        meta: {}
    },
    {
        name:'details-student',
        path: '/students/details/:student_id',
        component: StudentsDetails
    },
    {
        name: 'enrollments',
        path: '/enrollments',
        component: Enrollments,
        meta: {}
    }
]

const router = new Router({ routes })

export default router