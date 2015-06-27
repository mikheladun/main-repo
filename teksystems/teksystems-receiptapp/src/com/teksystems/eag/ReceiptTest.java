package com.teksystems.eag;

import junit.framework.Assert;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;

/**
 * This unit test case provides coverage for all methods in Receipt class 
 * 
 * @author Mikhel Adun
 *
 */
public class ReceiptTest {

	@Before
	public void setUp() throws Exception {
	}

	@After
	public void tearDown() throws Exception {
	}

	@Test
	public void testReceipt() {
		Assert.assertNotNull(Application.createReceipt(new Basket()));
	}

	@Test
	public void testCalculateTaxesAndTotal() {
		Basket basket = new Basket();
		basket.addItem(new Item(1, 12.49, true, false));
		basket.addItem(new Item(1, 14.99, false, false));
		basket.addItem(new Item(1, 0.85, true, false));
		Receipt receipt = new Receipt(basket);
		receipt.calculateTaxesAndTotal();
		Assert.assertEquals(1.5, receipt.getSalesTax());
		Assert.assertEquals(29.83, receipt.getTotalAmount());
	}

	@Test
	public void testToString() {
		Basket basket = new Basket();
		basket.addItem(new Item(1, 27.99, true, false));
		Receipt receipt = Application.createReceipt(basket);
		Assert.assertEquals("1 : 27.99\r\nSales Taxes: 0.00\r\nTotal: 27.99\r\n", receipt.toString());
	}

	@Test
	public void testGetSalesTax() {
		Basket basket = new Basket();
		basket.addItem(new Item(1, 10.00, true, true));
		basket.addItem(new Item(1, 47.50, false, true));
		Receipt receipt = Application.createReceipt(basket);
		Assert.assertEquals(7.65, receipt.getSalesTax());
	}

	@Test
	public void testGetTotalAmount() {
		Basket basket = new Basket();
		basket.addItem(new Item(1, 27.99, false, true));
		basket.addItem(new Item(1, 18.99, false, false));
		basket.addItem(new Item(1, 9.75, true, false));
		basket.addItem(new Item(1, 11.25, true, true));
		Receipt receipt = Application.createReceipt(basket);
		Assert.assertTrue(receipt.getTotalAmount() == 74.68);
	}

	@Test
	public void testSetBasket() {
		Receipt receipt = Application.createReceipt(new Basket());
		Assert.assertNotNull(receipt.getBasket());
		Basket basket = new Basket();
		basket.addItem(new Item(1, 27.99, false, true));
		receipt.setBasket(basket);
		Assert.assertEquals(basket, receipt.getBasket());
	}

	@Test
	public void testGetBasket() {
		Receipt receipt = new Receipt(new Basket());
		Assert.assertNotNull(receipt.getBasket());
	}

}
