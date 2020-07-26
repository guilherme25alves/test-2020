import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/Home'
import Courses from  '@/pages/courses/Courses'
import Students from '@/pages/students/Students'  
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
        name: 'enrollments',
        path: '/enrollments',
        component: Enrollments,
        meta: {}
    }
]

const router = new Router({ routes })

export default router