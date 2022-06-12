import { Injectable } from '@nestjs/common';
import { PrismaService } from '../prisma/prisma.service';
import { CreateTransactionDto } from './dto/create-transaction.dto';
import { UpdateTransactionDto } from './dto/update-transaction.dto';

@Injectable()
export class TransactionService {
  constructor(private prisma: PrismaService) {}

  create(createTransactionDto: CreateTransactionDto) {
    return this.prisma.transaction.create({ data: createTransactionDto });
  }

  async findAll(
    index = 0,
    step = 100,
    query: string | undefined,
    filterName: string,
    filterValue: string,
  ) {
    const transactions = await this.prisma.transaction.findMany({
      where: {
        title: { contains: query, mode: 'insensitive' },
        [filterName]: filterValue,
      },
      skip: index,
      take: step,
    });

    const count = await this.prisma.transaction.count({
      where: {
        title: { contains: query },
        [filterName]: filterValue,
      },
    });

    return { count: count, items: transactions };
  }

  async findOne(id: string) {
    const transaction = await this.prisma.transaction.findUnique({
      where: { id },
      rejectOnNotFound: true,
    });

    return transaction;
  }

  update(id: string, updateTransactionDto: UpdateTransactionDto) {
    return this.prisma.transaction.update({
      data: updateTransactionDto,
      where: { id },
    });
  }

  remove(id: string) {
    return this.prisma.transaction.delete({ where: { id } });
  }
}
