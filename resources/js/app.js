import "./bootstrap";
import "~resources/scss/app.scss";
import "./form/delete";
import "./toast"; //must be after form/delete but before img-preview
import "./form/is-published";
import "./form/img-preview";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);
