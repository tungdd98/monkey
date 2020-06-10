import Index from "./Index";
import AccountProfile from "./components/AccountProfile";
import HistoryOrder from "./components/HistoryOrder";
export default {
    path: "/profile",
    component: Index,
    children: [
        {
            name: "profile",
            path: "",
            component: AccountProfile
        },
        {
            name: "history-order",
            path: "/history-order",
            component: HistoryOrder
        }
    ],
    meta: { requiresAuth: true }
};
