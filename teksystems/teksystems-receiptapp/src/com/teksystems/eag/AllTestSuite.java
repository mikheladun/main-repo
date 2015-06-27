package com.teksystems.eag;

import org.junit.runner.RunWith;
import org.junit.runners.Suite;
import org.junit.runners.Suite.SuiteClasses;

/**
 * This unit test suite provides coverage for all test cases
 * 
 * @author Mikhel Adun
 *
 */
@RunWith(Suite.class)
@SuiteClasses({
    ItemTest.class,
    BasketTest.class,
    ReceiptTest.class,
    ApplicationTest.class
})
public class AllTestSuite {
}