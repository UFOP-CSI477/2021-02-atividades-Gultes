import { Injectable } from '@nestjs/common';
import { PrismaService } from '../prisma/prisma.service';
import { CreateItemDto } from './dto/create-item.dto';
import { UpdateItemDto } from './dto/update-item.dto';

@Injectable()
export class ItemsService {
  constructor(private prisma: PrismaService) {}

  create(createItemDto: CreateItemDto) {
    return this.prisma.items.create({ data: createItemDto });
  }

  findAll() {
    return this.prisma.items.findMany();
  }

  async findOne(id: string) {
    const item = await this.prisma.items.findUnique({
      where: { id },
      rejectOnNotFound: true,
    });

    return item;
  }

  update(id: string, updateItemDto: UpdateItemDto) {
    return this.prisma.items.update({
      data: updateItemDto,
      where: { id },
    });
  }

  remove(id: string) {
    return this.prisma.items.delete({ where: { id } });
  }
}
