import 'package:flutter/material.dart';
import '../constants.dart';

class AppbarProductDetail extends StatelessWidget {
  const AppbarProductDetail({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Row(
        children: [
          const Spacer(),
          Badge(
            child: InkWell(
              onTap: (){},
              child: const Icon(
                Icons.shopping_bag_outlined,
              ),
            ),
          ),
        ],
      ),
    );
  }
}


