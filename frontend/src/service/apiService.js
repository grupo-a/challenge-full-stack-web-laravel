import axios from "axios";

const apiClient = {
  async readStudents() {
    const response = await axios.get("/students")
    return response.data;
  },
  async createStudent(requestData) {
    return await axios.post("/students", requestData)
    // return response.data;
  },
  async updateStudent(id, requestData) {
    const response = await axios.put("/students/"+id, requestData);
    return response.data;
  },
  async deleteStudent(studentId) {
    const response = await axios.delete("/students/"+studentId);
    return response.data;
  }
};

export default apiClient;