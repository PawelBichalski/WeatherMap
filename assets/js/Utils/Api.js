
import axios from "axios";

export default axios.create({
  baseURL: "http://weathermap.localhost/api/",
  responseType: "json"
});
