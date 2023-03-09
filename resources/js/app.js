import "./bootstrap";
import "~resources/scss/app.scss";
import "./form/delete";
import "./form/is-published";
import "./toast"; //must be after form/delete but before img-preview
import "./form/img-preview";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);
