import 'package:demo1/cart/model/cart_model.dart';
import 'package:flutter/material.dart';
import 'package:getwidget/getwidget.dart';

import '../../constants.dart';


bool isChecked = true;
class CartItem extends StatelessWidget {
  const CartItem({Key? key, required this.cart}) : super(key: key);
  final Cart cart;

  @override
  Widget build(BuildContext context) {
    return Row(
      children: [
        GFCheckbox(
          size: 28,
          activeBgColor: GFColors.DANGER,
          // type: GFCheckboxType.square,
          onChanged: (value) {
            setState(() {
              isChecked = value;
            });
          },
          value: isChecked,
          inactiveIcon: null,
        ),
        const SizedBox(width: 10,),
        Image.asset(cart.image),
        const SizedBox(width: 10,),
        Expanded(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(cart.title,style: const TextStyle(color: backtitleColor,fontSize: 15,fontWeight: FontWeight.w400),),
              const SizedBox(height: 10,),
              RichText(
                text: TextSpan(
                  style: const TextStyle(color: priceColor,fontSize: 17,fontWeight: FontWeight.w400),
                  text: cart.pirce.toString(),
                  children: const <TextSpan>[
                    TextSpan(text: 'đ'),
                  ],
                ),
              ),
            ],
          ),
        ),
        const SizedBox(width: 10,),
        // const Spacer(),
        Row(
          children: [
            Container(
              width: 25,
              height: 25,
              decoration: BoxDecoration(
                color: Colors.white,
                border: Border.all(color: greyplus),
                borderRadius: BorderRadius.circular(100),
              ),
              child: Center(child: Text("-",style: TextStyle(color: greyplus,),)),
            ),

            Container(
              width: 28,
              height: 28,
              margin: EdgeInsets.symmetric(horizontal: 6),
              decoration: BoxDecoration(
                color: Colors.white,
                border: Border.all(color: greyplus),
                borderRadius: BorderRadius.circular(5),
              ),
              child: Center(child: Text("1")),
            ),

            Container(
              width: 25,
              height: 25,
              decoration: BoxDecoration(
                color: Colors.white,
                border: Border.all(color: greyplus),
                borderRadius: BorderRadius.circular(100),
              ),
              child: Center(child: Text("+",style: TextStyle(color: greyplus,),)),
            ),
          ],
        ),
      ],
    );
  }
}

void setState(Null Function() param0) {
}
