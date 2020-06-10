import Index from "./Index";
import Checkout from "./components/CheckOut";
import Information from "./components/Information";
import Success from "./components/Success";

import store from "@/store";
export default {
    path: "/checkout",
    component: Index,
    children: [
        {
            name: "information",
            path: "/information",
            component: Information
        },
        {
            name: "checkout",
            path: "",
            component: Checkout
        },
        {
            name: "success",
            path: "/success",
            component: Success
        }
    ],
    beforeEnter: (to, from, next) => {
        if (store.getters["cart/getCart"].all.length === 0) {
            next({
                path: "/"
            });
        } else {
            next();
        }
    }
};
