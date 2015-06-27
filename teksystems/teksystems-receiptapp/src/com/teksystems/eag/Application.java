package com.teksystems.eag;

import java.text.DecimalFormat;

/**
 * The Receipt application adds items to a shopping basket, calculates sales tax 
 * including import duty tax for each item and prints out the quantity, 
 * item name, price, sales taxes, and the total amount. 
 * 
 * Basic sales tax is applicable at a rate of 10% on all goods, except books,
 * food, and medical products that are exempt. Import duty is additional sales
 * tax applicable on all imported goods at a rate of 5%, with no exemptions.
 * 
 * When I purchase items I receive a receipt which lists the name of all items
 * and their price (including tax), finishing with the total cost of the items,
 * and the total amounts of sales taxes paid. The rounding rules for sales tax
 * are that for a tax rate of n%, a shelf price of p contains (np/100 rounded up
 * to the nearest 0.05) amount of sales tax.
 * 
 * @author Mikhel Adun
 * 
 */
public class Application {

	// 10% basic sales tax on all goods except books, food, and medical
	public static final double BASIC_SALES_TAX_RATE = 0.10;
	// 5% import duty tax on all imported goods
	public static final double IMPORT_DUTY_TAX_RATE = 0.05;
	public static final DecimalFormat DECIMAL_FORMAT = new DecimalFormat("0.00");

	/**
	 * Main
	 * @param args
	 */
	public static void main(String[] args) {
		/**
		 * Basket 1:
		 * 1 book at 12.49
		 * 1 music CD at 14.99
		 * 1 chocolate bar at 0.85
		 */
		Basket basket1 = new Basket();
		basket1.addItem(new Item(1, "book", 12.49, true, false));
		basket1.addItem(new Item(1, "music CD", 14.99, false, false));
		basket1.addItem(new Item(1, "chocolate bar", 0.85, true, false));
		System.out.println(createReceipt(basket1));

		/**
		 * Basket 2:
		 * 1 imported box of chocolates at 10.00
		 * 1 imported bottle of perfume at 47.50
		 */
		Basket basket2 = new Basket();
		basket2.addItem(new Item(1, "imported box of chocolates", 10.00, true, true));
		basket2.addItem(new Item(1, "imported bottle of perfume", 47.50, false, true));
		System.out.println(createReceipt(basket2));

		/**
		 * Basket 3:
		 * 1 imported bottle of perfume at 27.99
		 * 1 bottle of perfume at 18.99
		 * 1 packet of headache pills at 9.75
		 * 1 box of imported chocolates at 11.25
		 */
		Basket basket3 = new Basket();
		basket3.addItem(new Item(1, "imported bottle of perfume", 27.99, false, true));
		basket3.addItem(new Item(1, "bottle of perfume", 18.99, false, false));
		basket3.addItem(new Item(1, "packet of headache pills", 9.75, true, false));
		basket3.addItem(new Item(1, "box of imported chocolates", 11.25, true, true));
		System.out.println(createReceipt(basket3));
	}

	/**
	 * The rounding rules for sales tax are that for a tax rate of n%, a shelf price of p contains
	 * (np/100 rounded up to the nearest 0.05) amount of sales tax.
	 * 
	 * @param tax
	 * @return
	 */
	public static double roundTax(double tax)
	{
		//round off to nearest 0.05
		tax = Math.ceil(tax * 20) / 20;

		return (tax);
	}

	/**
	 * Calculates total sales taxes and total amount of items
	 */
	public static Receipt createReceipt(Basket basket) {
		Receipt receipt = new Receipt(basket);
		receipt.calculateTaxesAndTotal();

		return (receipt);
	}

	/**
	 * Calculates basic sales tax and import duty for item
	 */
	public static double calculateTax(Item item) {
		double tax = 0.0;

		// calculate import duty
		double importDuty = 0.0;
		if (item.isImported()) {
			importDuty = item.getPrice() * IMPORT_DUTY_TAX_RATE;
		}

		// calculate sales tax
		double salesTax = 0.0;
		if (!item.isExempt()) {
			salesTax = item.getPrice() * BASIC_SALES_TAX_RATE;
		}

		tax = roundTax(salesTax + importDuty);

		return (tax);
	}

}
