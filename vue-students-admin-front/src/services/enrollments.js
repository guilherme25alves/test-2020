import { http } from './config'

var config = {
    headers: {
       'Accept':'application/json',
       'Content-type':'application/json' 
    }
}

export default{

    listEnrollments:() => {
        return http.get('enrollments')
    },

    save:(enrollment) => {
        return http.post('enrollments', enrollment, config)
    },

    update:(enrollment) => {
        return http.put('enrollments/'+ enrollment.enrollment_id, enrollment, config)
    },

    getById:(enrollmentId) => {
        return http.get('enrollments/' + enrollmentId)
    },

    remove:(enrollmentId) => {
        return http.delete('enrollments/' + enrollmentId)
    },    
}