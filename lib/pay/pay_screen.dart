import 'package:flutter/material.dart';
import '../constants.dart';
import 'wedget/deliverytime.dart';
import 'wedget/receive.dart';

class PayScreen extends StatelessWidget {
  const PayScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text("Thanh toán",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 19,color: bLtitleColor),),
      ),
      body: Container(
        padding: EdgeInsets.symmetric(vertical: 0,horizontal: 20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          mainAxisAlignment: MainAxisAlignment.start,
          children: const [
            Receive(),
            SizedBox(height: 30,),
            DeliveryTime(),
          ],
        ),
      ),
    );
  }
}

