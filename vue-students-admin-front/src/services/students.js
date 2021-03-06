import { http } from './config'

var config = {
    headers: {
       'Accept':'application/json',
       'Content-type':'application/json' 
    }
}

export default{

    listStudents:() => {
        return http.get('students')
    },

    save:(student) => {
        return http.post('students', student, config)
    },

    update:(student) => {
        return http.put('students/'+ student.student_id, student, config)
    },

    getById:(studentId) => {
        return http.get('students/' + studentId)
    },

    remove:(studentId) => {
        return http.delete('students/' + studentId)
    },

    enrollmentsByStudent:(studentId) => {
        return http.get('students/enrollments/'+ studentId)
    },

    findByName:(name) => {
        return http.get('students/name/' + name)
    },

    findByEmail:(email) => {
        return http.get('students/email/' + email)
    },

    findByText:(text) => {
        return http.get('students/search-text/' + text)
    }
}