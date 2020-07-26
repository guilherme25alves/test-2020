import { http } from './config'

export default{

    listStudents:() => {
        return http.get('students')
    }
}