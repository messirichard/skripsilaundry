package id.placeholderlabs.laundry.util;

import java.text.DecimalFormat;
import java.text.DecimalFormatSymbols;

/**
 * Created by alfredo on 4/8/2018.
 */

public class CurrencyFormat {

    public static String rupiah(Float nominal)
    {
        DecimalFormat kursIndonesia = (DecimalFormat) DecimalFormat.getCurrencyInstance();
        DecimalFormatSymbols formatRp = new DecimalFormatSymbols();

        formatRp.setCurrencySymbol("Rp");
        formatRp.setMonetaryDecimalSeparator(',');
        formatRp.setGroupingSeparator('.');

        kursIndonesia.setDecimalFormatSymbols(formatRp);
        return kursIndonesia.format(nominal);
    }

}
