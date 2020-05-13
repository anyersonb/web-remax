const tarjeta = new Cleave(".input.tarjeta", {
	creditCard: true
})

const cvv = new Cleave(".input.cvv", {
	blocks: [4],
	numericOnly: true
})

const vencimiento = new Cleave(".input.vencimiento", {
	blocks: [2, 2],
	delimiter: "/",
	numericOnly: true
})
