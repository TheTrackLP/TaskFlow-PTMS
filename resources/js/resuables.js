import { Dropdown } from "bootstrap";
import { Modal } from "bootstrap";
import { nextTick } from "vue";

export const formattedDate = (dateValue) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateValue).toLocaleDateString("en-US", options);
};

// When openning a Modal
let modalInstanceForm = null;
export const openFormModal = (modalFormRef) => {
    nextTick(() => {
        if (!modalFormRef) return;
        modalInstanceForm = new Modal(modalFormRef.value);
        modalInstanceForm.show();
    });
};

// When closing a Modal
export const closeModal = (modalFormRef) => {
    nextTick(() => {
        if (!modalFormRef) return;
        modalInstanceForm?.hide();
    });
};

// When toggle a modal
export const dropdownToggle = (targetvalue) => {
    Dropdown.getOrCreateInstance(targetvalue.currentTarget).toggle();
};
