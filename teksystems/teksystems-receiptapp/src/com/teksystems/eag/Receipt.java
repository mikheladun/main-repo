package com.teksystems.eag;

/**
 * 
 * @author Mikhel Adun
 *
 */
public class Receipt {

	//total amount
	private double totalAmount = 0.00;
	//total sales tax including import duty
	private double salesTax = 0.00;
	//basket instance
	private Basket basket = null;

	/**
	 * Constructor
	 * @param basket
	 */
	public Receipt(Basket basket) {
		this.basket = basket;
	}

	/**
	 * Calculates sales tax and total costs
	 */
	public void calculateTaxesAndTotal() {
		totalAmount = 0.00;
		salesTax = 0.00;
		for (Item item : this.getBasket().getItems()) {
			double tax = Application.calculateTax(item);
			totalAmount += item.getPrice() + tax;
			salesTax += tax;
		}
	}

	/**
	 * Returns receipt in display format
	 * @param basket
	 * @return
	 */
	@Override
	public String toString() {
		StringBuffer details = new StringBuffer();
		details.append(basket);
		details.append("Sales Taxes: " + Application.DECIMAL_FORMAT.format(this.getSalesTax()));
		details.append("\r\n");
		details.append("Total: " + Application.DECIMAL_FORMAT.format(this.getTotalAmount()));
		details.append("\r\n");

		return (details.toString());
	}

	/**
	 * Calculate total sales tax of all items including import duty
	 * 
	 * @return totalTax
	 */
	public double getSalesTax() {
		return (Double.valueOf(Application.DECIMAL_FORMAT.format(this.salesTax)));
	}

	/**
	 * Calculates total amount of all items including sales tax and import
	 * duty
	 * 
	 * @return totalAmount
	 */
	public double getTotalAmount() {
		return (Double.valueOf(Application.DECIMAL_FORMAT.format(this.totalAmount)));
	}

	/**
	 * Setter for basket
	 * @param basket
	 */
	public void setBasket(Basket basket) {
		this.basket = basket;
	}
	/**
	 * Getter for basket
	 * @return
	 */
	public Basket getBasket() {
		return (this.basket);
	}

}
