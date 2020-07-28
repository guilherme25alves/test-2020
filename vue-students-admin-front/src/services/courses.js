import { http } from './config'

var config = {
    headers: {
       'Accept':'application/json',
       'Content-type':'application/json' 
    }
}

export default{

    listCourses:() => {
        return http.get('courses')
    },

    save:(course) => {
        return http.post('courses', course, config)
    },

    update:(course) => {
        return http.put('courses/'+ course.course_id, course, config)
    },

    getById:(courseId) => {
        return http.get('courses/' + courseId)
    },

    remove:(courseId) => {
        return http.delete('courses/' + courseId)
    },

    enrollmentsByCourse:(courseId) => {
        return http.get('courses/enrollments/'+ courseId)
    },

    findByTitle:(title) => {
        return http.get('courses/title/' + title)
    },    
}