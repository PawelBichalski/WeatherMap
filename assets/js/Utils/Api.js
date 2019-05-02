
import axios from "axios";

export default axios.create({
//  baseURL: "http://pawelbichalski.com.pl/api/",
    baseURL: "http://weathermap.localhost/api/",
  responseType: "json"
});
