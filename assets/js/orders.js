const modal = document.getElementById("paymentModal");

const closeModal = document.getElementById("closeModal");

document.querySelectorAll(".detail-btn").forEach(btn => {

    btn.addEventListener("click", function () {

        document.getElementById("modalInvoice").innerText =
            this.dataset.invoice;

        document.getElementById("modalName").innerText =
            this.dataset.name;

        document.getElementById("modalEmail").innerText =
            this.dataset.email;

        document.getElementById("modalBank").innerText =
            this.dataset.bank;

        document.getElementById("modalMethod").innerText =
            this.dataset.method;

        document.getElementById("modalTotal").innerText =
            "Rp " + this.dataset.total;

        document.getElementById("modalStatus").innerText =
            this.dataset.status;

        document.getElementById("modalProof").src =
            "../assets/images/" + this.dataset.proof;

        document.getElementById("approveBtn").href =
            "approve_order.php?id=" + this.dataset.id;

        document.getElementById("rejectBtn").href =
            "reject_order.php?id=" + this.dataset.id;

        modal.classList.add("show");

    });

});

closeModal.addEventListener("click", () => {

    modal.classList.remove("show");

});

modal.addEventListener("click", function(e){

    if(e.target === modal){

        modal.classList.remove("show");

    }

});